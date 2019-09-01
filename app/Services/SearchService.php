<?php


namespace App\Services;


use App\Contact;
use App\Requests\SearchRequest;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SearchService
{
    const AVAILABLE_MODIFIERS = [
        'fullName',
        'createAt',
        'customValue'
    ];

    /**
     * @var string
     */
    protected $table;


    public function __construct()
    {
        $this->table = 'contacts';
    }

    /**
     * @param SearchRequest $request
     * @return LengthAwarePaginator
     * @throws \Throwable
     */
    public function search(SearchRequest $request): LengthAwarePaginator
    {
        $eloquentBuilder = new EloquentBuilder(Contact::getQuery());
        $eloquentBuilder->setModel(new Contact());

        $fields = $request->getSearchFields();

        try {
            foreach ($fields as $fieldKey => $fieldData) {
                $modifierForFieldName = $fieldKey . 'Modifier';

                if (!method_exists($this, $modifierForFieldName) and !in_array($fieldKey, self::AVAILABLE_MODIFIERS)) {
                    continue;
                }

                $eloquentBuilder = $this->{$modifierForFieldName}($eloquentBuilder, $fieldData);
            }

            /**
             * @var LengthAwarePaginator $paginator
             */
            $paginator = $eloquentBuilder->paginate();

            return $paginator;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * @param EloquentBuilder $builder
     * @param string $string
     * @return EloquentBuilder
     */
    protected function fullNameModifier(EloquentBuilder $builder, string $string): EloquentBuilder
    {
        $columns = array_map(function ($column) {
            return $this->table . '.' . $column;
        }, Contact::COLUMN_FOR_SEARCH);

        $columnsStr = implode(',', $columns);

        $builder = $builder->whereRaw(DB::raw("MATCH ($columnsStr) AGAINST ('$string')"));

        return $builder;
    }


    protected function customValueModifier(EloquentBuilder $builder, string $countryStr): EloquentBuilder
    {
        $builder->whereHas('fields.options', function (EloquentBuilder $query) use ($countryStr) {
            $query->where('value', $countryStr);
        });
        
        return $builder;
    }

    /**
     * @param EloquentBuilder $builder
     * @param array $createAtData
     * @return EloquentBuilder
     */
    protected function createAtModifier(EloquentBuilder $builder, array $createAtData): EloquentBuilder
    {
        $builder->where($this->table . '.created_at', '>=', $createAtData['from']);
        $builder->where($this->table . '.created_at', '<=', $createAtData['to']);
        return $builder;
    }
}
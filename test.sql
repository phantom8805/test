SELECT
  docs.contact_id, CONCAT(contacts.name, ' ', contacts.surname) as full_name, docs.id as doc_id, docs.number as doc_number, docs.created_at as doc_create_at
FROM
  (SELECT
     docs.contact_id, docs.number, docs.deleted_at, MAX(created_at) AS created_at
   FROM
     docs
   WHERE docs.deleted_at IS NULL
   GROUP BY
     contact_id) AS latest_docs
INNER JOIN
  docs
ON
  docs.contact_id = latest_docs.contact_id AND docs.created_at = latest_docs.created_at
INNER JOIN
  contacts
ON
 contacts.id = docs.contact_id
WHERE contacts.deleted_at IS NULL
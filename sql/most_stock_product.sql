SELECT
    *
FROM
    products
WHERE
    deleted_at IS NULL
ORDER BY
    stock DESC
LIMIT
    1;

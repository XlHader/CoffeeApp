/**
 "Producto más vendido" se refiere al producto que ha generado el mayor número total de unidades vendidas a lo largo de todas las transacciones registradas.
 */

SELECT
    SUM(sales.amount) as total_selling_amount,
    products.*
FROM
    products
    INNER JOIN sales ON sales.product_id = products.id
WHERE
    products.deleted_at IS NULL
GROUP BY
    sales.product_id
ORDER BY
    SUM(sales.amount) DESC
LIMIT
    1;

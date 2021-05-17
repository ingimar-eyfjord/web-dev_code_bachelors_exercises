<?php
require "../db_service/dbc.php";
$result = pg_query($conn, 

"WITH
ProductQuantityByCountry AS 
(
SELECT
date_ordered as Date_ordered,
COUNT(order_number) as Order_quantity
FROM
orders
 GROUP BY
date_ordered
),
RankedProductQuantityByCountry
AS
(
SELECT
    RANK() OVER (PARTITION BY Date_ordered ORDER BY Date_ordered DESC) AS countryRank,
    *
FROM
    ProductQuantityByCountry
)
SELECT
*
FROM
RankedProductQuantityByCountry
WHERE
countryRank = 1
ORDER BY
Date_ordered DESC
Limit 30"
);
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

$resultchek = pg_num_rows($result);
$array = array();
if ($resultchek > 0)
    $tempArray = array();
while ($row = pg_fetch_assoc($result)) {
    $tempArray = $row;
    array_push($array, $row);
}
echo (json_encode($array));
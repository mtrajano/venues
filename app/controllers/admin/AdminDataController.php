<?php

class AdminDataController extends \BaseController {
	public function index(){

$query = <<<END_QUERY
SELECT
like_ranges.like_range AS number_likes,
temp.price,
AVG(temp.profit) AS profit
FROM (
  SELECT id,
     CASE
         WHEN number_likes = 0 THEN'0'
         WHEN number_likes > 0 AND number_likes <= 20 THEN '1-20'
         WHEN number_likes > 20 AND number_likes <= 100 THEN '20-100'
         WHEN number_likes > 100 AND number_likes <= 1000 THEN '100-1000'
         ELSE '1000+'
    END AS like_range
 FROM artists) like_ranges
INNER JOIN shows
ON like_ranges.id = shows.artist_id
INNER JOIN (SELECT show_id, price, (num_sales * price) AS profit FROM tickets) temp
ON shows.id = temp.show_id
GROUP BY like_ranges.like_range, temp.price
ORDER BY FIELD (number_likes, '0', '1-20', '20-100', '100-1000', '1000+'), price
END_QUERY;

		$profit_data = json_encode(DB::select(DB::raw($query)));

		Cache::forever('profit_data', $profit_data);

$query = <<<END_QUERY
SELECT AVG(num_sales) AS avg_sale, price 
FROM tickets 
GROUP BY price
ORDER BY price
END_QUERY;

		$price_sales = json_encode(DB::select(DB::raw($query)));

		Cache::forever('price_sales', $price_sales);

$query = <<<END_QUERY
SELECT
like_ranges.like_range AS number_likes,
AVG(tickets.num_sales) AS avg_sale
FROM (
  SELECT id,
     CASE
         WHEN number_likes = 0 THEN'0'
         WHEN number_likes > 0 AND number_likes <= 20 THEN '1-20'
         WHEN number_likes > 20 AND number_likes <= 100 THEN '20-100'
         WHEN number_likes > 100 AND number_likes <= 500 THEN '100-500'
         WHEN number_likes > 500 AND number_likes <= 1000 THEN '500-1000'
         WHEN number_likes > 1000 AND number_likes <= 5000 THEN '1000-5000'
         ELSE '5000+'
    END AS like_range
 FROM artists) like_ranges
INNER JOIN shows
ON like_ranges.id = shows.artist_id
INNER JOIN tickets
ON shows.id = tickets.show_id
GROUP BY number_likes
ORDER BY FIELD (number_likes, '0', '1-20', '20-100', '100-500', '500-1000','1000-5000', '5000+');
END_QUERY;

		$likes_sales = json_encode(DB::select(DB::raw($query)));

		Cache::forever('likes_sales', $likes_sales);

		return View::make('admin.data');
	}
}
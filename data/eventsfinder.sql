
SELECT 
most_mutual_by_category.event_name as event_name,
most_mutual_by_category.category as genre,
most_mutual_by_category.artist as artist,
(most_mutual_by_category.popularity + most_mutual_by_artist.popularity) AS mutual_popularity

FROM 

(SELECT e.id AS event_id, e.name as event_name,
    cats.category as category, cats.artist as artist,
    cats.category_id as category_id, cats.popularity as popularity
    FROM
    (SELECT 
        c.name as category,
        t.name as artist, 
        c.id as category_id,
        t.id as topic_id,
        COUNT(*) AS popularity 

        FROM topics t INNER JOIN categories c ON t.category_id = c.id
        INNER JOIN likes l ON l.topic_id = t.id
        INNER JOIN users u ON l.user_id = u.id
        

        WHERE u.id = 1
        OR u.f_name LIKE '%s%' OR u.l_name LIKE '%s%'
        GROUP BY category_id
    ) cats
    INNER JOIN events e ON e.topic_id = cats.topic_id
) most_mutual_by_category

LEFT JOIN 

(SELECT 
    e1.id as event_id, arts.artist_id as artist_id, arts.popularity as popularity
    FROM
    (SELECT t1.id as artist_id, 
        COUNT(*) AS popularity 

        FROM topics t1 INNER JOIN likes l1 ON t1.id = l1.topic_id
        INNER JOIN users u1 ON l1.user_id = u1.id
        WHERE u1.id = 1
        OR u1.f_name LIKE '%%' OR u1.l_name LIKE '%%'
        GROUP BY artist_id) arts
    INNER JOIN events e1 ON e1.topic_id = arts.artist_id

    
) most_mutual_by_artist

ON most_mutual_by_artist.event_id = most_mutual_by_category.event_id

ORDER BY mutual_popularity DESC;
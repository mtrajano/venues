# Find users to go to event with you:
SELECT users_who_like_topic_or_category.user_id as user_id, 
        users_who_like_topic_or_category.f_name as f_name,
        users_who_like_topic_or_category.l_name as l_name,
        users_who_like_topic_or_category.email as email,
        users_who_like_topic_or_category.event_name as event_name,
        users_who_like_topic_or_category.topic_name as topic_name

 FROM 

(   
    SELECT users_who_like_category.user_id as user_id,
    users_who_like_category.f_name as f_name,
    users_who_like_category.l_name as l_name,
    users_who_like_category.email as email,
    (users_who_like_category.category_like_idx +
    users_who_like_topic.topic_like_idx) as total_like_idx,
    e.name as event_name,
    topics.name as topic_name

    FROM events e
    INNER join topics ON e.topic_id = topics.id,

    (SELECT u.id as user_id, u.f_name as f_name, u.l_name as l_name, u.email as email
    , 1 as topic_like_idx FROM users u
        INNER JOIN likes l ON u.id = l.user_id
        INNER JOIN topics t ON l.topic_id = t.id
        INNER JOIN events e ON e.topic_id = t.id
        WHERE e.topic_id = t.id) users_who_like_topic

    RIGHT JOIN

    (SELECT u1.id as user_id, u1.f_name as f_name, u1.l_name as l_name, u1.email as email,
        1 as category_like_idx FROM users u1
        INNER JOIN likes l1 on u1.id = l1.user_id
        INNER JOIN topics t1 on l1.topic_id = t1.id
        INNER JOIN events e ON e.topic_id = t1.id
        INNER JOIN categories c on t1.category_id = c.id
        WHERE t1.category_id = c.id) users_who_like_category

    ON users_who_like_topic.user_id = users_who_like_category.user_id


    WHERE e.name LIKE '%pi%'
    OR topics.name LIKE '%pi%'
) users_who_like_topic_or_category

ORDER BY total_like_idx, event_name desc

LIMIT 10
;
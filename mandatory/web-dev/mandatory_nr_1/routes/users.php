<?php

get('/users', 'views/view_users.php');
get('/single_user/$id', 'views/view_single_user.php');

post('/users/delete/$id', 'service/delete_user.php');
  
<?php

get('/', 'views/view_profile.php');
get('/profile', 'views/view_profile.php');
post('/profile/deactivate', 'service/deactivate.php');
post('/profile/reactivate', 'service/auth_reactivate.php');
post('/profile/upload/image', 'service/upload_profile_img.php');
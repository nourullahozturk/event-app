<?php

filter_var(false, FILTER_VALIDATE_BOOLEAN); // false
filter_var('false', FILTER_VALIDATE_BOOLEAN); // false

session_start();

date_default_timezone_set('Turkey');

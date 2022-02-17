<?php

$pasword = '123';

echo preg_match('/^[a-zA-Z0-9]{6,9}$/', $pasword);
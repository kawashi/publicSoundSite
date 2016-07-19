<?php
return array(
    '_root_'  => 'publicSound/show',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
    
    '(:any)'  => 'publicSound/$1'
);

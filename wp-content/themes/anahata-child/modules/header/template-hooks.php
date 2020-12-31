<?php

//top header bar
add_action('anahata_mikado_before_page_header', 'anahata_mikado_get_header_top');

//mobile header
add_action('anahata_mikado_after_page_header', 'anahata_mikado_get_mobile_header');
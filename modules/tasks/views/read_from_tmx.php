<?php
if (from_trongate_mx()) {
    echo 'The request came from Trongate MX';
} else {
    echo 'The request did not come from Trongate MX';
}
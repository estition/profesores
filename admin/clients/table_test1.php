<?php 

/*print_r( preg_filter ("$^(?i:(?=[MDCLXVI])((M{0,3})((C[DM])|(D?C{0,3}))?((X[LC])|(L?XX{0,2})|L)?((I[VX])|(V?(II{0,2}))|V)?))$", "", " PHP is the web scrIpting language  of choice. IV"));*/

$string = 'PHP is  the web  scrIpting(iiiifghr) IV';
$pepe =  str_replace(" ", "", $string);
$pattern = '/(?i:(?=[MDCLXVI]+)((M{0,3})((C[DM])|(D?C{0,3}))?((X[LC])|(L?XX{0,2})|L)?((I[VX])|(V?(II{0,2}))|V)?))/';
$replacement = '*';

print_r(preg_split($pattern, $string));
//^(?i:(?=[MDCLXVI])((M{0,3})((C[DM])|(D?C{0,3}))?((X[LC])|(L?XX{0,2})|L)?((I[VX])|(V?(II{0,2}))|V)?))$
///^(?=.)(?i)M*(D?C{0,3}|C[DM])(L?X{0,3}|X[LC])(V?I{0,3}|I[VX])$/
?>
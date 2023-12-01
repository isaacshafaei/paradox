<?php $perfix = 'paradox_'; 
$grpup_link = get_post_meta(get_the_ID(  ), $perfix.'download_group',true);
if($grpup_link){ 
    foreach($grpup_link as $links){
    ?>
    <a href="<?php echo esc_html($links[$perfix.'link_adder_dowanload'] ); ?>"><i class="fa fa-download"></i><?php echo esc_html( $links[ $perfix.'title_link_adder_dowanload'] );  ?></a>
<?php }
}
?>

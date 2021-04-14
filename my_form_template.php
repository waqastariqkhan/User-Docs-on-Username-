<div id="display-form">
	<form id="usernameForm" name="usernameForm" class="form-inline" method="POST" action='/'>
  <input type="username" id="email" placeholder="" name="username">
  <button type="submit" name="submitUsername">Login</button>
		</form>
	<div style="display:block;margin-top:10px;">
		 <a style="font-family: Montserrat;font-style: normal;font-weight: normal;font-size: 14px;line-height: 17px;color: #5C8EBF;">Forgot Username?</a>
	</div>

</div>

<?php

if (isset($_POST['submitUsername'])) {
$username = $_POST['username'];
if(!isset($username) || trim($username) == '')
{
   echo "<h3 style=color:red;margin-top:20px;> Das FeldLiegenschaftscode ist leer </h3>";
}
else{
    $args = array(
        'numberposts'	=> -1,
        'post_type'		=> 'userdoc',
        'name' => $username,
    );
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ): ?>
       
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="building">
            <img class="img-valign" src="http://stweg.hit-ag.ch/wp-content/uploads/2021/03/Group-1.png" alt="" />
            <span class="text-heading">STWEG</span>  
            </div>
            <ul>
            <?php if( have_rows('document') ):
            while( have_rows('document') ) : the_row();
                $sub_value = get_sub_field('sub_field');?>
                <li>
                <div class="fileHierarchy">
                <a target="blank" href="<?php the_sub_field('document_attachment'); ?>">
                <img class="img-file" src="http://stweg.hit-ag.ch/wp-content/uploads/2021/03/Group-6-1.png" alt="" />
                <span class="text-files"><?php the_sub_field('document_name'); ?></span>  
                </a>
                </div>
                <?php endwhile;
                else :
                endif; ?>
                </li>
                <li>
               <?php if( have_rows('hierarchy') ): $i = 0;
                    while( have_rows('hierarchy') ) : the_row(); $i++; ?>
                    <div class="folderHierarchy">
                        <a class="folder" id="<?php echo $i; ?>" href="#">
                        <img class="img-file" src="<?php the_sub_field('folder_image'); ?>" alt="" />
                        <span class="text-files"><?php the_sub_field('folder_heading'); ?></span>  
                        </a>
                        <div style="margin-left:40px;display:none;" class="under-<?php echo $i; ?>"> 
                            <?php if( have_rows('document_hierarchy') ): 
                                while( have_rows('document_hierarchy') ) : the_row(); ?>
                                <div class="fileHierarchy">
                                <a target="blank" href="<?php the_sub_field('document_attachment_hierarchy'); ?>">
                                <img class="img-file" src="http://stweg.hit-ag.ch/wp-content/uploads/2021/03/Group-6-1.png" alt="" />
                                <span class="text-files"><?php the_sub_field('document_name_hierarchy'); ?></span>  
                                </a> 
                                </div>
                            <?php  endwhile; ?>
                            <?php endif;?>
                        </div>
                  
                <?php endwhile; ?>
                <?php  endif; ?>
                       </div>
                </li>
            </ul>
        <?php endwhile; ?>
        <?php else: ?>
            <div style="margin-top:30px;" class="invalidUsername ">
            <span style="color:red" class="text-heading">Liegenschaftscode ungültig/nicht gefunden</span>  
            </div>
    <?php endif; 
}

}

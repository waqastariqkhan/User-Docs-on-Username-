<div id="display-form">
	<form id="usernameForm" name="usernameForm" class="form-inline" method="POST" action='/'>
  <input type="username" id="email" placeholder="" name="username">
  <button type="submit" name="submitUsername">Login</button>
		</form>
	<div style="display:block;margin-top:10px;">
		 <a style="font-family: Montserrat;font-style: normal;font-weight: normal;font-size: 14px;line-height: 17px;color: #5C8EBF;" href="mailto:info@hit-ag.ch?cc=&bcc=&subject=[stweg.hit-ag.ch] Zugriffscode vergessen&body=Grüezi%0D%0A%0D%0A
Leider finde ich meinen Zugangscode I'm Stockwerkeigentümerprotokoll nicht mehr.%0D%0A
Bitte senden sie mir den Code zu den folgenden Angaben zu.%0D%0A%0D%0A
Vorname:%0D%0A
Name:%0D%0A
Stockwerkeigentümergemeinschaft:%0D%0A%0D%0A
Herzlichen Dank und freundliche Grüsse%0D%0A">Code vergessen?</a>
	</div>

</div>

<style>
	@media only screen and (max-width: 800px) {
	/* Form Template CSS */
	.img-valign {
  vertical-align: middle;
  margin-bottom: 15px;
}
.text-heading {
    font-size: 16px !Important;
    margin-left: 10px !Important;
    color: #5C8EBF !Important;
    font-weight: 400 !Important;
}
	.text-files {
    font-size: 12px !Important;
    margin-left: 18px !Important;
    color: #5C8EBF !important;
}
}

.img-valign {
  max-width:50px;  
  vertical-align: middle;
  margin-bottom: 15px;
}
.img-file{
    vertical-align: middle;
    max-width:30px; 
}

.text-heading {
    font-size: 25px;
    margin-left: 17px;
    color: #5C8EBF;
    font-weight: 400;
}
.text-files{
    font-size: 16px;
    margin-left: 18px;
    color: #5C8EBF;
}
.building{
    border-bottom: 1px solid #5C8EBF;
    margin-top:50px
}
.fileHierarchy{
    margin:30px 0px 15px 0px;
}
#left-area ul, .comment-content ul, .entry-content ul, .et-l--body ul, .et-l--footer ul, .et-l--header ul, body.et-pb-preview #main-content .container ul {
    list-style-type: none;
}
.folderHierarchy{
    margin:30px 0px 15px 0px;
}
.fileHierarchy.under{
    margin: 30px 19px 15px 30px;
}
</style>

<script>
jQuery(document).ready(function($){
    
$("a.folder").click(function(event){
    event.preventDefault();
    var id = jQuery(this).attr("id");
    console.log(id);
    $('.under-'+ id).toggle();
});

var aVisible = $('.building').css('display');
if (aVisible == 'block') {
    $('#display-form').css('display','none');
	$('#second-heading').css('display','none');
	$('div#logout').css('display','block');
}

});
</script>
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
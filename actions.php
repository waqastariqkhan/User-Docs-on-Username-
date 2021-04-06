<?php
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'userdoc',
	'title' => 'waqas_41',
);
$the_query = new WP_Query( $args );
if( $the_query->have_posts() ): ?>
	<ul>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li>
			<a href="#">
				<?php the_field('document_1'); ?>
				<?php the_field('document_2'); ?>
				<?php the_title(); ?>
			</a>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; 


if (isset($_POST['submitUsername'])) {

$username = $_POST['submitUsername'];
echo $username;
$args = array(
    'numberposts'	=> -1,
    'post_type'		=> 'userdoc',
    'title' => $username,
);
$the_query = new WP_Query( $args );
if( $the_query->have_posts() ): ?>
<div>
  <img class="img-valign" src="http://agefenfr.local/wp-content/uploads/2021/03/Vector.png" alt="" />
  <span class="text1">STWE Steinweid</span>  
</div>
    <ul>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li>
            <a href="#">
                <?php the_field('document_1'); ?>
                <?php the_field('document_2'); ?>
                <?php the_title(); ?>
            </a>
        </li>
    <?php endwhile; ?>
    </ul>
<?php endif; 
}



$(function () {
    $('#usernameForm').on('submit', function (e) {
        var self = this; //Keep a reference to the form that was submitted
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'), 
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function () {
                 $(self).hide(); //Hide the form if the request was successful 
            },
            error: function () { alert('Failed to send email'); }
        });

    });
});

});
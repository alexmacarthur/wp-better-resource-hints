<?php
	namespace BetterResourceHints;
  use BetterResourceHints\App;
?>

<div class="PromoBar">

	<h2 class="PromoBar-title">Has <em><?php echo App::$copy['public']; ?></em> been useful? Share the news!</h2>

	<ul class="FeedbackList">
		<li class="FeedbackList-item FeedbackItem">
			<a class="FeedbackItem-link FeedbackItem-link--github" href="https://github.com/alexmacarthur/wp-better-resource-hints" target="_blank">
				<?php echo file_get_contents(plugin_dir_path( __FILE__ ) . '../assets/img/github.svg'); ?>
			</a>
			<span class="FeedbackItem-text"><p><a href="https://github.com/alexmacarthur/wp-better-resource-hints">Star</a> it.</p></span>
		</li>
		<li class="FeedbackList-item FeedbackItem">
			<a class="FeedbackItem-link" href="https://wordpress.org/plugins/better-resource-hints/?rate=5#new-post" target="_blank">
				<?php echo file_get_contents(plugin_dir_path( __FILE__ ) . '../assets/img/wordpress.svg'); ?>
			</a>
			<span class="FeedbackItem-text"><p><a href="https://wordpress.org/plugins/better-resource-hints/?rate=5#new-post">Review</a> it.</p></span>
		</li>
		<li class="FeedbackList-item FeedbackItem">
			<a class="FeedbackItem-link" href="https://twitter.com/home?status=I've%20seen%20some%20serious%20performance%20improvements%20after%20installing%20%40amacarthur's%20Better%20Resource%20Hints%20plugin%20for%20%23WordPress!%20https%3A//wordpress.org/plugins/better-resource-hints/" target="_blank">
				<?php echo file_get_contents(plugin_dir_path( __FILE__ ) . '../assets/img/twitter.svg'); ?>
			</a>
			<span class="FeedbackItem-text"><p><a href="https://twitter.com/home?status=I've%20seen%20some%20serious%20performance%20improvements%20after%20installing%20%40amacarthur's%20Better%20Resource%20Hints%20plugin%20for%20%23WordPress!%20https%3A//wordpress.org/plugins/better-resource-hints/">Tweet</a> about it.</p></span>
		</li>
		<li class="FeedbackList-item FeedbackItem">
			<a class="FeedbackItem-link FeedbackItem-link--mail" href="https://macarthur.me/contact" target="_blank">
				<?php echo file_get_contents(plugin_dir_path( __FILE__ ) . '../assets/img/envelope.svg'); ?>
			</a>
			<span class="FeedbackItem-text"><p><a href="https://macarthur.me/contact">Email</a> me.</p></span>
		</li>
	</ul>

	<h4 class="PromoBar-sub">This plugin was created with care by <a href="https://macarthur.me">Alex MacArthur</a>. Thanks for using it!</h4>

</div>

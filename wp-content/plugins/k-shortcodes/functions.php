<?php
/**
 * Misc funtions
 *
 * @since  1.0
 * @author LunarTheme
 * @link   http://www.lunartheme.com
 */

/*-------------------------------------------------------------------
	Social channel.
--------------------------------------------------------------------*/
if ( ! function_exists( 'k2t_social_array' ) ) {
	function k2t_social_array() {
		return array(
			'facebook'		=>	__( 'Facebook', 'k2t-shortcodes' ),
			'twitter'		=>	__( 'Twitter', 'k2t-shortcodes' ),
			'google-plus'	=>	__( 'Google+', 'k2t-shortcodes' ),
			'linkedin'	 	=>	__( 'LinkedIn', 'k2t-shortcodes' ),
			'tumblr'	 	=>	__( 'Tumblr', 'k2t-shortcodes' ),
			'pinterest'	 	=>	__( 'Pinterest', 'k2t-shortcodes' ),
			'youtube'	 	=>	__( 'YouTube', 'k2t-shortcodes' ),
			'skype'	 		=>	__( 'Skype', 'k2t-shortcodes' ),
			'instagram'	 	=>	__( 'Instagram', 'k2t-shortcodes' ),
			'delicious'	 	=>	__( 'Delicious', 'k2t-shortcodes' ),
			'reddit'		=>	__( 'Reddit', 'k2t-shortcodes' ),
			'stumbleupon'	=>	__( 'StumbleUpon', 'k2t-shortcodes' ),
			'wordpress'	 	=>	__( 'Wordpress', 'k2t-shortcodes' ),
			'joomla'		=>	__( 'Joomla', 'k2t-shortcodes' ),
			'blogger'	 	=>	__( 'Blogger', 'k2t-shortcodes' ),
			'vimeo'	 		=>	__( 'Vimeo', 'k2t-shortcodes' ),
			'yahoo'	 		=>	__( 'Yahoo!', 'k2t-shortcodes' ),
			'flickr'	 	=>	__( 'Flickr', 'k2t-shortcodes' ),
			'picasa'	 	=>	__( 'Picasa', 'k2t-shortcodes' ),
			'deviantart'	=>	__( 'DeviantArt', 'k2t-shortcodes' ),
			'github'	 	=>	__( 'GitHub', 'k2t-shortcodes' ),
			'stackoverflow'	=>	__( 'StackOverFlow', 'k2t-shortcodes' ),
			'xing'	 		=>	__( 'Xing', 'k2t-shortcodes' ),
			'flattr'	 	=>	__( 'Flattr', 'k2t-shortcodes' ),
			'foursquare'	=>	__( 'Foursquare', 'k2t-shortcodes' ),
			'paypal'	 	=>	__( 'Paypal', 'k2t-shortcodes' ),
			'yelp'	 		=>	__( 'Yelp', 'k2t-shortcodes' ),
			'soundcloud'	=>	__( 'SoundCloud', 'k2t-shortcodes' ),
			'lastfm'	 	=>	__( 'Last.fm', 'k2t-shortcodes' ),
			'lanyrd'	 	=>	__( 'Lanyrd', 'k2t-shortcodes' ),
			'dribbble'	 	=>	__( 'Dribbble', 'k2t-shortcodes' ),
			'forrst'	 	=>	__( 'Forrst', 'k2t-shortcodes' ),
			'steam'	 		=>	__( 'Steam', 'k2t-shortcodes' ),
			'behance'		=>	__( 'Behance', 'k2t-shortcodes' ),
			'mixi'			=>	__( 'Mixi', 'k2t-shortcodes' ),
			'weibo'			=>	__( 'Weibo', 'k2t-shortcodes' ),
			'renren'		=>	__( 'Renren', 'k2t-shortcodes' ),
			'evernote'		=>	__( 'Evernote', 'k2t-shortcodes' ),
			'dropbox'		=>	__( 'Dropbox', 'k2t-shortcodes' ),
			'bitbucket'		=>	__( 'Bitbucket', 'k2t-shortcodes' ),
			'trello'		=>	__( 'Trello', 'k2t-shortcodes' ),
			'vk'			=>	__( 'VKontakte', 'k2t-shortcodes' ),
			'home'			=>	__( 'Homepage', 'k2t-shortcodes' ),
			'envelope-alt'	=>	__( 'Email', 'k2t-shortcodes' ),
			'rss'			=>	__( 'RSS', 'k2t-shortcodes' ),
		);
	}
}
<?php
namespace ARKHE_THEME\Widget;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * 既存の「最新の投稿」ウィジェットのフォーマットを編集（投稿日をaタグの中へ）
 */
class Recent_Posts extends \wp_widget_recent_posts {

	// 既存の widget メソッドを上書き
	function widget( $args, $instance ) {

		$title = apply_filters(
			'widget_title',
			empty( $instance['title'] ) ? __( 'Recent Posts', 'arkhe' ) : $instance['title'],
			$instance,
			$this->id_base
		);

		$number = absint( $instance['number'] );
		if ( empty( $instance['number'] ) || ! $number ) {
			$number = 10;
		}
		$q = new \WP_Query(
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				)
			)
		);
		if ( $q->have_posts() ) :
			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'], $title, $args['after_title'];
			}
			echo '<ul>';
			while ( $q->have_posts() ) :
				$q->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
					<?php if ( ! empty( $instance['show_date'] ) ) : ?>
						<span class="recent_entries_date u-color-thin u-fz-s"><?php the_time( 'Y.m.d' ); ?></span>
					<?php endif; ?>
				</a></li>
				<?php
			endwhile;
			echo '</ul>';
			echo $args['after_widget'];
			wp_reset_postdata();
		endif;
	}
}

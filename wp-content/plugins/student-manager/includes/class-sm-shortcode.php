<?php
/**
 * Shortcode for displaying students list
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class SM_Shortcode {

    public function __construct() {
        add_shortcode( 'danh_sach_sinh_vien', array( $this, 'render_shortcode' ) );
    }

    public function render_shortcode( $atts ) {
        // Query all students
        $args = array(
            'post_type'      => 'sinh_vien',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $query = new WP_Query( $args );

        // Start output buffering
        ob_start();

        if ( $query->have_posts() ) : ?>
            <div class="sm-student-list-container">
                <table class="sm-student-table">
                    <thead>
                        <tr>
                            <th><?php _e( 'STT', 'student-manager' ); ?></th>
                            <th><?php _e( 'MSSV', 'student-manager' ); ?></th>
                            <th><?php _e( 'Họ tên', 'student-manager' ); ?></th>
                            <th><?php _e( 'Lớp', 'student-manager' ); ?></th>
                            <th><?php _e( 'Ngày sinh', 'student-manager' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        while ( $query->have_posts() ) : $query->the_post();
                            $mssv      = get_post_meta( get_the_ID(), '_sm_mssv', true );
                            $lop       = get_post_meta( get_the_ID(), '_sm_lop', true );
                            $ngay_sinh = get_post_meta( get_the_ID(), '_sm_ngay_sinh', true );
                            
                            // Format date to display (assuming Y-m-d format is saved)
                            $formatted_date = ! empty( $ngay_sinh ) ? date_i18n( get_option( 'date_format' ), strtotime( $ngay_sinh ) ) : '';
                            ?>
                            <tr>
                                <td><?php echo esc_html( $stt ); ?></td>
                                <td><?php echo esc_html( $mssv ); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html( $lop ); ?></td>
                                <td><?php echo esc_html( $formatted_date ); ?></td>
                            </tr>
                            <?php
                            $stt++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p><?php _e( 'Hiện chưa có sinh viên nào.', 'student-manager' ); ?></p>
        <?php endif;

        // Return output buffer content
        return ob_get_clean();
    }
}

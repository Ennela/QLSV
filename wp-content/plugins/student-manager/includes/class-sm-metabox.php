<?php
/**
 * Meta Box for Students
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class SM_MetaBox {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
    }

    public function add_meta_boxes() {
        add_meta_box(
            'sm_student_info',
            __( 'Thông tin sinh viên bổ sung', 'student-manager' ),
            array( $this, 'render_meta_box' ),
            'sinh_vien',
            'normal',
            'default'
        );
    }

    public function render_meta_box( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'sm_save_student_info', 'sm_student_info_nonce' );

        // Retrieve existing values from the database.
        $mssv      = get_post_meta( $post->ID, '_sm_mssv', true );
        $lop       = get_post_meta( $post->ID, '_sm_lop', true );
        $ngay_sinh = get_post_meta( $post->ID, '_sm_ngay_sinh', true );
        
        $lop_options = array(
            ''          => __( '--- Chọn lớp/Chuyên ngành ---', 'student-manager' ),
            'CNTT'      => __( 'Công nghệ thông tin', 'student-manager' ),
            'Kinh tế'   => __( 'Kinh tế', 'student-manager' ),
            'Marketing' => __( 'Marketing', 'student-manager' ),
        );

        ?>
        <table class="form-table">
            <tr>
                <th><label for="sm_mssv"><?php _e( 'Mã số sinh viên (MSSV)', 'student-manager' ); ?></label></th>
                <td>
                    <input type="text" id="sm_mssv" name="sm_mssv" value="<?php echo esc_attr( $mssv ); ?>" class="regular-text" required />
                </td>
            </tr>
            <tr>
                <th><label for="sm_lop"><?php _e( 'Lớp/Chuyên ngành', 'student-manager' ); ?></label></th>
                <td>
                    <select id="sm_lop" name="sm_lop" required>
                        <?php foreach ( $lop_options as $value => $label ) : ?>
                            <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $lop, $value ); ?>><?php echo esc_html( $label ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="sm_ngay_sinh"><?php _e( 'Ngày sinh', 'student-manager' ); ?></label></th>
                <td>
                    <input type="date" id="sm_ngay_sinh" name="sm_ngay_sinh" value="<?php echo esc_attr( $ngay_sinh ); ?>" required />
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_meta_boxes( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['sm_student_info_nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['sm_student_info_nonce'], 'sm_save_student_info' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Sanitize and save MSSV
        if ( isset( $_POST['sm_mssv'] ) ) {
            $mssv = sanitize_text_field( wp_unslash( $_POST['sm_mssv'] ) );
            update_post_meta( $post_id, '_sm_mssv', $mssv );
        }

        // Sanitize and save Lớp
        if ( isset( $_POST['sm_lop'] ) ) {
            $lop = sanitize_text_field( wp_unslash( $_POST['sm_lop'] ) );
            update_post_meta( $post_id, '_sm_lop', $lop );
        }

        // Sanitize and save Ngày sinh
        if ( isset( $_POST['sm_ngay_sinh'] ) ) {
            $ngay_sinh = sanitize_text_field( wp_unslash( $_POST['sm_ngay_sinh'] ) );
            update_post_meta( $post_id, '_sm_ngay_sinh', $ngay_sinh );
        }
    }
}

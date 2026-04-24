<?php
/**
 * Custom Post Type for Students
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class SM_CPT {

    public function __construct() {
        add_action( 'init', array( $this, 'register_cpt' ) );
    }

    public function register_cpt() {
        $labels = array(
            'name'                  => _x( 'Sinh viên', 'Post Type General Name', 'student-manager' ),
            'singular_name'         => _x( 'Sinh viên', 'Post Type Singular Name', 'student-manager' ),
            'menu_name'             => __( 'Sinh viên', 'student-manager' ),
            'name_admin_bar'        => __( 'Sinh viên', 'student-manager' ),
            'archives'              => __( 'Danh sách Sinh viên', 'student-manager' ),
            'attributes'            => __( 'Thuộc tính Sinh viên', 'student-manager' ),
            'parent_item_colon'     => __( 'Sinh viên cha:', 'student-manager' ),
            'all_items'             => __( 'Tất cả Sinh viên', 'student-manager' ),
            'add_new_item'          => __( 'Thêm Sinh viên mới', 'student-manager' ),
            'add_new'               => __( 'Thêm mới', 'student-manager' ),
            'new_item'              => __( 'Sinh viên mới', 'student-manager' ),
            'edit_item'             => __( 'Sửa Sinh viên', 'student-manager' ),
            'update_item'           => __( 'Cập nhật Sinh viên', 'student-manager' ),
            'view_item'             => __( 'Xem Sinh viên', 'student-manager' ),
            'view_items'            => __( 'Xem Danh sách', 'student-manager' ),
            'search_items'          => __( 'Tìm kiếm Sinh viên', 'student-manager' ),
            'not_found'             => __( 'Không tìm thấy sinh viên nào', 'student-manager' ),
            'not_found_in_trash'    => __( 'Không tìm thấy sinh viên trong thùng rác', 'student-manager' ),
            'featured_image'        => __( 'Ảnh đại diện', 'student-manager' ),
            'set_featured_image'    => __( 'Đặt ảnh đại diện', 'student-manager' ),
            'remove_featured_image' => __( 'Xóa ảnh đại diện', 'student-manager' ),
            'use_featured_image'    => __( 'Sử dụng làm ảnh đại diện', 'student-manager' ),
            'insert_into_item'      => __( 'Chèn vào sinh viên', 'student-manager' ),
            'uploaded_to_this_item' => __( 'Tải lên cho sinh viên này', 'student-manager' ),
            'items_list'            => __( 'Danh sách Sinh viên', 'student-manager' ),
            'items_list_navigation' => __( 'Điều hướng danh sách sinh viên', 'student-manager' ),
            'filter_items_list'     => __( 'Lọc danh sách sinh viên', 'student-manager' ),
        );
        $args = array(
            'label'                 => __( 'Sinh viên', 'student-manager' ),
            'description'           => __( 'Quản lý thông tin sinh viên', 'student-manager' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-welcome-learn-more',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'sinh_vien', $args );
    }
}

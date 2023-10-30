<?php
/*
Plugin Name: Group 4
Description: A basic payment plugin for WordPress.
Version: 1.0
*/

function add_payment_page()
{
    add_menu_page('Payment Page', 'Payment Page', 'manage_options', 'payment-page', 'display_payment_page');
}

function save_payment_info($name, $qr_image_url)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'payments';

    $wpdb->insert(
        $table_name,
        array(
            'recipient_name' => $name,
            'qr_image' => $qr_image_url,
        )
    );

    if ($wpdb->last_error) {
        echo "Lỗi SQL: " . $wpdb->last_error;
    }
}

add_action('admin_menu', 'add_payment_page');

function display_payment_page()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_text_field($_POST['recipient_name']);

        if (isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] === 0) {
            $uploaded_file = wp_handle_upload($_FILES['qr_image'], array('test_form' => false));
            if (!is_wp_error($uploaded_file) && isset($uploaded_file['url'])) {
                $qr_image_url = $uploaded_file['url'];
                // Xử lý và lưu thông tin
                save_payment_info($name, $qr_image_url);
            }
        }
    }

    // Hiển thị biểu mẫu cho người dùng
    echo '<div class="wrap">';
    echo '<h2>Payment Page</h2>';
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<label for="qr_image">Hình ảnh QR:</label>';
    echo '<input type="file" id="qr_image" name="qr_image" accept="image/*" required><br>';
    echo '<label for="recipient_name">Tên người nhận:</label>';
    echo '<input type="text" id="recipient_name" name="recipient_name" required><br>';
    echo '<input type="submit" name="submit" value="Lưu">';
    echo '</form>';
    echo '</div>';

    global $wpdb;
    $table_name = $wpdb->prefix . 'payments';
    $payments = $wpdb->get_results("SELECT * FROM $table_name");

    if (!empty($payments)) {
        echo '<h2>Danh sách thanh toán</h2>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>Họ tên</th><th>Địa chỉ</th><th>Số điện thoại</th></tr></thead>';
        echo '<tbody>';
        foreach ($payments as $payment) {
            echo '<tr>';
            echo '<td>' . $payment->full_name . '</td>';
            echo '<td>' . $payment->address . '</td>';
            echo '<td>' . $payment->phone_number . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

    echo '</div>';
}

add_action('admin_menu', 'add_payment_page');
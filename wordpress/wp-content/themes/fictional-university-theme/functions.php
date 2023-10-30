<?php
function my_theme_support()
{
    add_theme_support('post-thumbnails');
    add_theme_support('add_custom_image_header');
}
add_action('after_setup_theme', 'my_theme_support');

function university_files()
{
    wp_enqueue_style('main_style', get_theme_file_uri('/build/index.css'));
    wp_enqueue_style('second_style', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('third_style', get_theme_file_uri('/style.css'));
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    //load JS
    // wp_enqueue_script('/build/index.js');
}
add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocation1', 'Footer Menu Location 1');
    register_nav_menu('footerMenuLocation2', 'Footer Menu Location 2');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 100,
    ));
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'university_features');

function custom_payment_shortcode()
{
    ob_start();
?>

    <div class="text-center d-block">
        <h1>Thông tin thanh toán</h1>
        <p class="p-0 m-0">Chọn phương thức thanh toán:</p>
        <div class="d-flex justify-content-center">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Thanh toán khi nhận hàng
                </label>
            </div>
            <div class="form-check" style="margin-left: 15px;">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">Chuyển khoản
                </label>
            </div>
        </div>
        <div id="option1_form">
            <form method="post" action="" class="w-50 d-block m-auto">
                <div class="form-group">
                    <label for="full_name">Họ tên:</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" name="submit_option1" value="Lưu">
                </div>
            </form>
        </div>
        <div id="bank_account_div">
            <?php
            global $wpdb;
            // Lấy thông tin thanh toán từ bảng dữ liệu
            $table_name = $wpdb->prefix . 'payments';
            $payment = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE qr_image IS NOT NULL ORDER BY id DESC LIMIT 1"));
            if ($payment) {
                echo '<p class="p-0 m-0">Tên người nhận: ' . $payment->recipient_name . '</p>';
                echo '<div class="w-25 m-auto h-auto">';
                echo '<img src="' . $payment->qr_image . '" alt="" class="w-100">';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <script>
        var bankAccountDiv = document.getElementById("bank_account_div");
        var cashDiv = document.getElementById("option1_form");
        document.getElementById("radio2").addEventListener("click", function() {
            if (this.value === "option2") {
                bankAccountDiv.style.display = "block";
                cashDiv.style.display = "none";
            } else {
                bankAccountDiv.style.display = "none";
                cashDiv.style.display = "block";
            }
        });
        document.getElementById("radio1").addEventListener("click", function() {
            if (this.value === "option1") {
                bankAccountDiv.style.display = "none";
                cashDiv.style.display = "block";
            } else {
                bankAccountDiv.style.display = "block";
                cashDiv.style.display = "none";
            }
        });
    </script>
    <?php
    //Lưu thông tin vào database
    function save_option1_info($full_name, $address, $phone_number)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'payments';

        $wpdb->insert(
            $table_name,
            array(
                'full_name' => $full_name,
                'address' => $address,
                'phone_number' => $phone_number,
            )
        );

        if ($wpdb->last_error) {
            echo "Lỗi SQL: " . $wpdb->last_error;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_option1'])) {
        $full_name = sanitize_text_field($_POST['full_name']);
        $address = sanitize_text_field($_POST['address']);
        $phone_number = sanitize_text_field($_POST['phone_number']);

        // Thực hiện lưu thông tin vào cơ sở dữ liệu
        save_option1_info($full_name, $address, $phone_number);
    }
    ?>
<?php
    $content = ob_get_clean();
    return $content;
}
add_shortcode('custom_payment', 'custom_payment_shortcode');

// Sử dụng Action Hook
function display_random_events() {
    $args = array(
        'post_type' => 'post', // Loại bài viết
        'posts_per_page' => 5, // Số bài viết muốn hiển thị
        'orderby' => 'rand', // Sắp xếp ngẫu nhiên
    );

    $random_events = new WP_Query($args);

    if ($random_events->have_posts()) {
        while ($random_events->have_posts()) {
            $random_events->the_post();
            echo '<div class="event-summary">';
            echo '<a class="event-summary__date event-summary__date--beige t-center" href="#">';
            echo '<span class="event-summary__month">' . get_the_date('M') . '</span>';
            echo '<span class="event-summary__day">' . get_the_date('d') . '</span>';
            echo '</a>';
            echo '<div class="event-summary__content">';
            echo '<h5 class="event-summary__title headline headline--tiny"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
            echo '<p>' . get_the_excerpt() . ' <a href="' . get_permalink() . '" class="nu gray">Read more</a></p>';
            echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
    }
}
add_action('custom_random_events', 'display_random_events');

// Sử dụng Filter Hook
add_filter('the_content', 'my_custom_content_filter');

function my_custom_content_filter($content) {
    return $content . '<p>Nội dung thêm vào nội dung bài viết.</p>';
}

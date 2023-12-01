<?php 
require_once TEMPLATEPATH . '/inc/plugins/cmb2/init.php';
require_once TEMPLATEPATH . '/inc/cmb2-tabs.php';
add_action( 'cmb2_admin_init', 'faneshyar_metaboxes' );
function faneshyar_metaboxes(){

    if(class_exists('Redux')){
        $choose_product_page =  paradox_settings('choose_product_page');
    }

    $perfix = 'paradox_';
    $textdomain = 'paradox';

        /**
     * Initiate the metabox
     */
    $paradox_matabox = new_cmb2_box( array(
        'id'            => $perfix.'page_setting_metabox',
        'title'         => __( 'تنظیمات صفحه', $textdomain ),
        'object_types'  => array( 'page','post','product' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'tabs'=> array(
            array(
                'id' => $perfix.'tabs-1',
                'icon' => 'dashicons-category',
                'title'=> __( 'تنظیمات صفحه', $textdomain ),
                'fields'=> array(
                    $perfix.'disable_top_bar',
                    $perfix.'disable_header',
                    $perfix.'disable_page_title',
                    $perfix.'disable_bredacrumb_page',
                    $perfix.'disable_footer',
                ),
            ),
            array(
                'id' => $perfix.'tabs-2',
                'icon' => 'dashicons-category',
                'title'=> __( 'تنظیمات استایل هدر', $textdomain ),
                'fields'=> array(
                    $perfix.'header_bg_color',
                    $perfix.'header_bg_img',
                ),
            ),
        ),
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'غیرفعال کردن نوار بالا', $textdomain ),
        'id'         => $perfix.'disable_top_bar',
        'type'       => 'checkbox',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'غیرفعال کردن عنوان صفحه', $textdomain ),
        'id'         => $perfix.'disable_page_title',
        'type'       => 'checkbox',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'غیرفعال کردن مسیرهای سایت', $textdomain ),
        'id'         => $perfix.'disable_bredacrumb_page',
        'type'       => 'checkbox',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'غیرفعال کردن فوتر', $textdomain ),
        'id'         => $perfix.'disable_footer',
        'type'       => 'checkbox',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'رنگ پس زمینه', $textdomain ),
        'id'         => $perfix.'header_bg_color',
        'type'       => 'colorpicker',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'تصویر پس زمینه', $textdomain ),
        'id'         => $perfix.'header_bg_img',
        'type'       => 'file',
    ) );

    //post setting section
    $paradox_matabox = new_cmb2_box( array(
        'id'            => $perfix.'post_setting_metabox',
        'title'         => __( 'تنظیمات نوشته', $textdomain ),
        'object_types'  => array( 'post' ), // Post type
        'context'       => 'normal',
        'show_names'    => true, // Show field names on the left
        'tabs'=> array(
            array(
                'id' => $perfix.'tabs-1',
                'icon' => 'dashicons-category',
                'title'=> __( 'تنظیمات سایدبار', $textdomain ),
                'fields'=> array(
                    $perfix.'disable_sidebar',
                ),
            ),
            array(
                'id' => $perfix.'tabs-2',
                'icon' => 'dashicons-microphone',
                'title'=> __( 'تنظیمات نوشته صوتی', $textdomain ),
                'fields'=> array(
                    $perfix.'sound_upload',
                    $perfix.'padcast_number',
                    $perfix.'padcast_time',
                    $perfix.'square_padcast_image',
                ),
            ),
            array(
                'id' => $perfix.'tabs-3',
                'icon' => 'dashicons-video-alt3',
                'title'=> __( 'تنظیمات نوشته ویدیویی', $textdomain ),
                'fields'=> array(
                    $perfix.'video_upload',
                    $perfix.'video_cover_upload',
                ),
            ),
            array(
                'id' => $perfix.'tabs-4',
                'icon' => 'dashicons-download',
                'title'=> __( 'باکس دانلود نوشته', $textdomain ),
                'fields'=> array(
                    $perfix.'download_box_title',
                    $perfix.'user_logged_in_can_see',
                    $perfix.'download_box_text',
                    $perfix.'zip_password',
                    $perfix.'download_link',
                    $perfix.'first_link_title',
                    $perfix.'first_link',
                    $perfix.'second_link_title',
                    $perfix.'second_link',
                    $perfix.'third_link_title',
                    $perfix.'third_link',
                    $perfix.'fourth_link_title',
                    $perfix.'fourth_link',
                    $perfix.'fifth_link_title',
                    $perfix.'fifth_link',
                    $perfix.'download_group',
                    $perfix.'title_link_adder_dowanload',
                    $perfix.'link_adder_dowanload',
                ),
            ),
            array(
                'id' => $perfix.'tabs-5',
                'icon' => 'dashicons-admin-appearance',
                'title'=> __( 'دوره های مرتبط', $textdomain ),
                'fields'=> array(
                    $perfix.'related_course_post',
                ),
            ),
        ),
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'غیر فعال کردن سایدبار فقط برای این نوشته', $textdomain ),
        'id'         => $perfix.'disable_sidebar',
        'type'       => 'checkbox',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'آپلود فایل صوتی شما', $textdomain ),
        'id'         => $perfix.'sound_upload',
        'type'       => 'file',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'شماره پادکست', $textdomain ),
        'id'         => $perfix.'padcast_number',
        'desc' => __( 'اینجا باید شماره پادکست را به دلخواه وارد کنید (مثلا : شماره 57)', $textdomain ),
        'type'       => 'text',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'مدت زمان پادکست', $textdomain ),
        'id'         => $perfix.'padcast_time',
        'desc' => __( 'اینجا باید زمان پادکست را وارد کنید (مثلا : 10:48)', $textdomain ),
        'type'       => 'text',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'آپلود تصویر برای المان', $textdomain ),
        'id'         => $perfix.'square_padcast_image',
        'desc' => __( 'اینجا می تونید یک تصویر دلخواه برای نمایش در المان پادکست انتخاب کنید اگر خالی بگذارید تصویر شاخص این پست به عنوان تصویر در نظر گرفته می شود.', $textdomain ),
        'type'       => 'file',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'آپلود فایل ویدیویی شما', $textdomain ),
        'id'         => $perfix.'video_upload',
        'type'       => 'file',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'پوستر کاور ویدئو', $textdomain ),
        'id'         => $perfix.'video_cover_upload',
        'type'       => 'file',
    ) );

    //download box fields
    $paradox_matabox->add_field( array(
        'name'       => __( 'تنظیمات مربوط به باکس دانلود نوشته', $textdomain ),
        'id'         => $perfix.'download_box_title',
        'desc' => __( 'به کمک این بخش می توانید فایل های قابل دانلود نوشته خود را در باکس دانلود درج کنید', $textdomain ),
        'type'       => 'title',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'محدود کردن مشاهده لینک های دانلود به اعضای وارد شده', $textdomain ),
        'id'         => $perfix.'user_logged_in_can_see',
        'desc' => __( 'اگر این گزینه را تیک بزنید، فقط اعضایی که عضو و وارد حساب کاربری خود شده باشند لینک ها را مشاهده خواهند کرد.', $textdomain ),
        'type'       => 'checkbox',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'محل وارد کردن متن دلخواه شما برای باکس دانلود', $textdomain ),
        'id'         => $perfix.'download_box_text',
        'type'       => 'wysiwyg',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'پسورد فایل های زیپ', $textdomain ),
        'id'         => $perfix.'zip_password',
        'desc' => __( 'اگر پسورد ندارد بنویسید : ندارد.', $textdomain ),
        'type'       => 'text',
    ) );
    $paradox_matabox->add_field( array(
        'name'       => __( 'لینک های دانلود', $textdomain ),
        'id'         => $perfix.'download_link',
        'desc' => __( 'لینک های دانلود خود را در فیلد های زیر وارد کنید', $textdomain ),
        'type'       => 'title',
    ) );    
    $group_field_download = $paradox_matabox->add_field( array(
        'id'          => $perfix.'download_group',
        'type'        => 'group',
        'description' => __( 'برای اضافه کردن لینک دانلود بیشتر',$textdomain ),
        'options'     => array(
            'group_title'       => __( 'لینک دانلود', $textdomain ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'اضافه کردن لینک دانلود', $textdomain ),
            'remove_button'     => __( 'حذف لینک دانلود', $textdomain ),
            'sortable'          => false,
        ),
    ) );

    $paradox_matabox->add_group_field( $group_field_download, array(
        'name' => __( 'عنوان لینک',$textdomain ),
        'id'   => $perfix.'title_link_adder_dowanload',
        'type' => 'text',
    ) );
    $paradox_matabox->add_group_field( $group_field_download, array(
        'name' => __( 'نشانی لینک',$textdomain ),
        'id'   => $perfix.'link_adder_dowanload',
        'type' => 'text_url',
    ) );
    $paradox_matabox->add_field( array(
        'name' => __( 'دسته بندی مرتبط دوره ها با این نوشته',$textdomain ),
        'desc' => __( 'فقط کافی است که نامک دسته بندی های مورد نظر را اینجا وارد کنید. دسته بندی ها را با کاما , از هم جدا کنید. مثلا: wordpress,joomla',$textdomain ),
        'id'   => $perfix.'related_course_post',
        'type' => 'text',
    ) );
    if($choose_product_page=='ostad'){
        //course metabox
        $courses_metaboxes = new_cmb2_box( array(
            'id'            => $perfix . 'courses_metabox',
            'title'         => __( 'تنظیمات دوره', $textdomain),
            'object_types'  => array( 'product' ), // Post type
            'vertical_tabs' => false, // Set vertical tabs, default false
            'tabs' => array(
    
                            array(
                    'id'    => 'tab-1',
                    'icon' => 'dashicons-welcome-learn-more',
                    'title' => 'ویژگی های دوره',
                    'fields' => array(
                                        $perfix . 'course_add_to_cart_text',
                                        $perfix . 'course_teacher',
                                        $perfix . 'course_teacher_2',
                                        $perfix . 'course_language',
                                        $perfix . 'course_duration',
                                        $perfix . 'course_type',
                                        $perfix . 'course_prerequisite',
                                        $perfix . 'course_start_date',
                                        $perfix . 'course_update_date',
                                        $perfix . 'course_file_size',
                                        $perfix . 'course_lesseons',
                                        $perfix . 'course_support',
                                        $perfix . 'course_receive_type',
                                        $perfix . 'course_certificate',
                                        $perfix . 'course_level',
                                        $perfix . 'course_percent',
                                        $perfix.'feture_group',
                                        $perfix . 'feture_title',
                                        $perfix . 'feture_input',
                    ),
                ),
    
                            array(
                    'id'    => 'tab-2',
                    'icon' => 'dashicons-format-video',
                    'title' => 'ویدئو پیشنمایش دوره',
                    'fields' => array(
                                        $perfix . 'course_disable_image',
                                        $perfix . 'course_video',
                                        $perfix . 'poster_video_coures',
                    ),
                ),
                            array(
                    'id'    => 'tab-3',
                    'icon' => 'dashicons-location',
                    'title' => 'محل برگزاری',
                    'fields' => array(
                                        $perfix . 'location_google_map',
                    ),
                ),
    
    
            )
        ) );
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'متن سفارشی دکمه ثبت نام', $textdomain ),
            'desc' => esc_html__( 'می توانید متن دکمه خرید دوره را سفارشی وارد کنید', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_add_to_cart_text',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'استاد دوره', $textdomain ),
            'desc' => esc_html__( 'استاد دوره را انتخاب کنید', $textdomain ),
            'id' => $perfix . 'course_teacher',
            'type' => 'select',
            'options' => paradox_get_teachers_list()
        ) );
    
            $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'مدرس دوم (اختیاری)', $textdomain ),
            'desc' => esc_html__( 'مدرس دوم را در صورت وجود انتخاب کنید', $textdomain ),
            'id' => $perfix . 'course_teacher_2',
            'type' => 'select',
            'options' => paradox_get_teachers_list()
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'زبان', $textdomain ),
            'id'   => $perfix . 'course_language',
            'type' => 'text',
            'default' => ''
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'زمان دوره', $textdomain ),
            'desc' => esc_html__( 'زمان دوره به ساعت', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_duration',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'نوع دوره', $textdomain ),
            'desc' => esc_html__( 'مثلا دروه حضوری است یا غیر حضوری؟', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_type',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'پیش نیاز دوره', $textdomain ),
            'desc' => esc_html__( 'مثلا HTML CSS', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_prerequisite',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'تاریخ شروع دوره', $textdomain ),
            'desc' => esc_html__( 'مثلا: 11 اردیبهشت 1397', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_start_date',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'تاریخ بروزرسانی دوره', $textdomain ),
            'desc' => esc_html__( 'مثلا: 11 اردیبهشت 1397', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_update_date',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'حجم کل دوره', $textdomain ),
            'desc' => esc_html__( 'مثلا: 450 مگابایت', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_file_size',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'درس ها', $textdomain ),
            'desc' => esc_html__( 'تعداد درس هایی که دوره دارد', $textdomain ),
            'default' => '',
            'id'   => $perfix . 'course_lesseons',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'روش پشتیبانی', $textdomain ),
            'desc' => esc_html__( 'مثلا: تلفنی یا ارسال تیکت', $textdomain ),
            'id'   => $perfix . 'course_support',
            'type' => 'text',
            'default' => ''
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'روش دریافت', $textdomain ),
            'desc' => esc_html__( 'مثلا: دانلود فایل دورس', $textdomain ),
            'id'   => $perfix . 'course_receive_type',
            'type' => 'text',
            'default' => ''
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'مدرک', $textdomain ),
            'id'   => $perfix . 'course_certificate',
            'type' => 'text',
            'default' => ''
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'سطح مهارت', $textdomain ),
            'id'   => $perfix . 'course_level',
            'type' => 'text',
            'default' => ''
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'درصد پیشرفت دوره', $textdomain ),
            'id'   => $perfix . 'course_percent',
            'desc' => esc_html__( 'فقط عدد را بدون علامت درصد وارد کنید.', $textdomain ),
            'type' => 'text',
            'default' => ''
        ) );
    
        $courses_group_feture = $courses_metaboxes->add_field( array(
            'id'          => $perfix.'feture_group',
            'type'        => 'group',
            'description' => __( 'ویژگی های سفارشی دلخواه برای محصول', $textdomain ),
            'options'     => array(
                'group_title'       => __( 'ویژگی های سفارشی', $textdomain ),
                'add_button'        => __( 'افزودن ویژگی جدید', $textdomain ),
                'remove_button'     => __( 'حذف ویژگی', $textdomain ),
                'sortable'          => true,
            ),
        ) );
    
        $courses_metaboxes->add_group_field( $courses_group_feture, array(
            'name' => esc_html__( 'عنوان ویژگی', $textdomain ),
            'id'   => $perfix . 'feture_title',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_group_field( $courses_group_feture, array(
            'name' => esc_html__( 'مقدار روبروی ویژگی', $textdomain ),
            'id'   => $perfix . 'feture_input',
            'type' => 'text',
        ) );

        $courses_metaboxes->add_group_field( $courses_group_feture, array(
            'name' => esc_html__( 'آیکون ویژگی', $textdomain ),
            'desc' => esc_html__( 'اینجا باید کلاس آیکون را وارد کنید', $textdomain ),
            'id'   => $perfix . 'feture_icon',
            'type' => 'text',
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'فعال کردن حالت پیش نمایش ویدیو دوره', $textdomain ),
            'desc' => esc_html__( 'اگر این گزینه را تیک بزنید به جای تصویر شاخص پیش فرض دوره تصویر و ویدیو این بخش به جای آن نمایش داده می شود.', $textdomain ),
            'id'   => $perfix . 'course_disable_image',
            'type' => 'checkbox',
            'default' => ''
        ) );

        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'آدرس ویدیو را اضافه کنید', $textdomain ),
            'desc' => esc_html__( 'پشتیبانی از: لینک مستقیم, Youtube لینک, Vimeo لینک.', $textdomain ),
            'id'   => $perfix . 'course_video',
            'type' => 'file',
            'default' => ''
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'پوستر کاور ویدئو', $textdomain ),
            'id'   => $perfix . 'poster_video_coures',
            'type' => 'file',
            'options' => array(
            'url' => true,
            ),
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'کد نقشه گوگل', $textdomain),
            'desc' => esc_html__( 'کد Embed a map محل مورد نظر خود که از اشتراک گذاری گوگل مپ دریافت کرده اید را وارد کنید.',$textdomain),
            'id'   => $perfix . 'location_google_map',
            'type' => 'textarea_code',
        ) );
    
        //Extra content Metabox
        $extra_metaboxes = new_cmb2_box( array(
            'id'           => 'extra_metabox',
                'title'        => esc_html__( 'ناحیه اضافی برای استفاده دلخواه', $textdomain ),
                'object_types' => array( 'product' ),
                'context'      => 'normal',
                'priority'     => 'core',
                'show_names'   => true,
        ) );
    
        $extra_metaboxes->add_field( array(
            'name' => esc_html__( 'محل وارد کردن متن،کد یا شرتکد دلخواه شما', $textdomain ),
            'id'   => $perfix.'extra_content',
            'type' => 'wysiwyg',
        ) );

        //Teacher Metabox
        $teacher_metaboxes = new_cmb2_box( array(
            'id'           => $perfix.'teacher_metaboxes',
                'title'        => esc_html__( 'اطلاعات استاد', $textdomain ),
                'object_types' => array( 'teacher' ),
                'context'      => 'normal',
                'show_names'   => true,
        ) );
    
        $teacher_metaboxes->add_field( array(
            'name' => esc_html__( 'شغل استاد', $textdomain ),
            'id'   => $perfix.'job_text',
            'type' => 'text',
        ) );
    }elseif ($choose_product_page =='rocket') {
    /**
     * Rocket metabox
     */
    //post setting section
    $paradox_matabox = new_cmb2_box( array(
        'id'            => $perfix.'post_setting_metabox',
        'title'         => __( 'تنظیمات نوشته', $textdomain ),
        'object_types'  => array( 'post' ), // Post type
        'context'       => 'normal',
        'show_names'    => true, // Show field names on the left
        'tabs'=> array(
            array(
                'id' => $perfix.'tabs-1',
                'icon' => 'dashicons-category',
                'title'=> __( 'تنظیمات سایدبار', $textdomain ),
                'fields'=> array(
                    $perfix.'disable_sidebar',
                ),
            ),
            array(
                'id' => $perfix.'tabs-2',
                'icon' => 'dashicons-microphone',
                'title'=> __( 'تنظیمات نوشته صوتی', $textdomain ),
                'fields'=> array(
                    $perfix.'sound_upload',
                    $perfix.'padcast_number',
                    $perfix.'padcast_time',
                    $perfix.'square_padcast_image',
                ),
            ),
            array(
                'id' => $perfix.'tabs-3',
                'icon' => 'dashicons-video-alt3',
                'title'=> __( 'تنظیمات نوشته ویدیویی', $textdomain ),
                'fields'=> array(
                    $perfix.'video_upload',
                    $perfix.'video_cover_upload',
                ),
            ),
            array(
                'id' => $perfix.'tabs-4',
                'icon' => 'dashicons-download',
                'title'=> __( 'باکس دانلود نوشته', $textdomain ),
                'fields'=> array(
                    $perfix.'download_box_title',
                    $perfix.'user_logged_in_can_see',
                    $perfix.'download_box_text',
                    $perfix.'zip_password',
                    $perfix.'download_link',
                    $perfix.'first_link_title',
                    $perfix.'first_link',
                    $perfix.'second_link_title',
                    $perfix.'second_link',
                    $perfix.'third_link_title',
                    $perfix.'third_link',
                    $perfix.'fourth_link_title',
                    $perfix.'fourth_link',
                    $perfix.'fifth_link_title',
                    $perfix.'fifth_link',
                    $perfix.'download_group',
                    $perfix.'title_link_adder_dowanload',
                    $perfix.'link_adder_dowanload',
                ),
            ),
        ),
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'آپلود فایل صوتی شما', $textdomain ),
        'id'         => $perfix.'sound_upload',
        'type'       => 'file',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'شماره پادکست', $textdomain ),
        'id'         => $perfix.'padcast_number',
        'desc' => __( 'اینجا باید شماره پادکست را به دلخواه وارد کنید (مثلا : شماره 57)', $textdomain ),
        'type'       => 'text',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'مدت زمان پادکست', $textdomain ),
        'id'         => $perfix.'padcast_time',
        'desc' => __( 'اینجا باید زمان پادکست را وارد کنید (مثلا : 10:48)', $textdomain ),
        'type'       => 'text',
    ) );

    $paradox_matabox->add_field( array(
        'name'       => __( 'آپلود تصویر برای المان', $textdomain ),
        'id'         => $perfix.'square_padcast_image',
        'desc' => __( 'اینجا می تونید یک تصویر دلخواه برای نمایش در المان پادکست انتخاب کنید اگر خالی بگذارید تصویر شاخص این پست به عنوان تصویر در نظر گرفته می شود.', $textdomain ),
        'type'       => 'file',
    ) );

             //course metabox
             $courses_metaboxes = new_cmb2_box( array(
                'id'            => $perfix . 'courses_metabox',
                'title'         => __( 'تنظیمات دوره', $textdomain),
                'object_types'  => array( 'product' ), // Post type
                'vertical_tabs' => false, // Set vertical tabs, default false
                'tabs' => array(
                    array(
                        'id'    => 'tabs-1',
                        'icon' => 'dashicons-editor-justify',
                        'title' => __( 'جلسات دوره', $textdomain),
                        'fields' => array(
                                            $perfix . 'course_sessions_group',
                        ),
                    ),
                    array(
                        'id'    => 'tabs-2',
                        'icon' => 'dashicons-editor-ul',
                        'title' => __( 'سوالات متداول دوره', $textdomain),
                        'fields' => array(
                                            $perfix .'faq_question_group',
                                            $perfix . 'faq_title',
                                            $perfix . 'answer_faq',
                        ),
                    ),
                        array(
                        'id'    => 'tabs-3',
                        'icon' => 'dashicons-welcome-learn-more',
                        'title' => 'ویژگی های دوره',
                        'fields' => array(
                                            $perfix . 'course_teacher',
                                            $perfix . 'course_duration',
                                            $perfix . 'course_session_number',
                                            $perfix . 'course_file_size',
                                            $perfix . 'course_update_date',
                                            $perfix . 'course_support',
                                            $perfix . 'course_status',
                                            $perfix . 'vip_active',
                                            $perfix . 'guarantee_active',
                        ),
                    ),
                        array(
                        'id'    => 'tabs-4',
                        'icon' => 'dashicons-format-video',
                        'title' => 'ویدئو پیشنمایش دوره',
                        'fields' => array(
                                            $perfix . 'rcourse_disable_image',
                                            $perfix . 'rcourse_video',
                                            $perfix . 'rposter_video_coures',
                        ),
                    ),
                )
            ) );
        
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'استاد دوره', $textdomain ),
                'desc' => esc_html__( 'استاد دوره را انتخاب کنید', $textdomain ),
                'id' => $perfix . 'course_teacher',
                'type' => 'select',
                'options' => paradox_get_teachers_list()
            ) );
            
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'زمان دوره', $textdomain ),
                'desc' => esc_html__( 'زمان دوره به ساعت', $textdomain ),
                'default' => '',
                'id'   => $perfix . 'course_duration',
                'type' => 'text',
            ) );
        
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'تعداد جلسات', $textdomain ),
                'desc' => esc_html__( 'مثلا : 43', $textdomain ),
                'default' => '',
                'id'   => $perfix . 'course_session_number',
                'type' => 'text',
            ) );
        
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'حجم دوره', $textdomain ),
                'desc' => esc_html__( 'مثلا : 450 مگابایت', $textdomain ),
                'default' => '',
                'id'   => $perfix . 'course_file_size',
                'type' => 'text',
            ) );
    
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'تاریخ بروزرسانی دوره', $textdomain ),
                'desc' => esc_html__( 'مثلا : 1401/05/02', $textdomain ),
                'default' => '',
                'id'   => $perfix . 'course_update_date',
                'type' => 'text',
            ) );
    
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'پشتیبان دوره', $textdomain ),
                'desc' => esc_html__( 'مثلا : از طریق واتساپ', $textdomain ),
                'default' => '',
                'id'   => $perfix . 'course_support',
                'type' => 'text',
            ) );
        
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'وضعیت دوره', $textdomain ),
                'desc' => esc_html__( 'مثلا : درحال برگذاری...', $textdomain ),
                'default' => '',
                'id'   => $perfix . 'course_status',
                'type' => 'text',
            ) );
        
            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'فعال کردن باکس عضویت ویژه', $textdomain ),
                'desc' => esc_html__( 'اگر این گزینه را تیک بزنید باکس عضویت ویژه برای این دوره اضافه می شود.', $textdomain ),
                'id'   => $perfix . 'vip_active',
                'type' => 'checkbox',
                'default' => ''
            ) );

            $courses_metaboxes->add_field( array(
                'name' => esc_html__( 'فعال کردن باکس گارانتی', $textdomain ),
                'desc' => esc_html__( 'اگر این گزینه را تیک بزنید باکس گارنتی برای این دوره اضافه می شود.', $textdomain ),
                'id'   => $perfix . 'guarantee_active',
                'type' => 'checkbox',
                'default' => ''
            ) );

            $courses_group_feture = $courses_metaboxes->add_field( array(
                'id'          => $perfix.'faq_question_group',
                'type'        => 'group',
                'description' => __( 'سوالات متدوال دوره رو می تونید از این بخش اضافه کنید.', $textdomain ),
                'options'     => array(
                    'group_title'       => __( 'سوالات متدوال', $textdomain ),
                    'add_button'        => __( 'افزودن سوال', $textdomain ),
                    'remove_button'     => __( 'حذف سوال', $textdomain ),
                    'sortable'          => true,
                ),
            ) );

            $courses_metaboxes->add_group_field( $courses_group_feture, array(
                'name' => esc_html__( 'عنوان سوال', $textdomain ),
                'id'   => $perfix . 'faq_title',
                'type' => 'text',
            ) );    
    
            $courses_metaboxes->add_group_field( $courses_group_feture, array(
                'name' => esc_html__( 'پاسخ سوال', $textdomain ),
                'id'   => $perfix . 'answer_faq',
                'type' => 'wysiwyg',
            ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'فعال کردن حالت پیش نمایش ویدیو دوره', $textdomain ),
            'desc' => esc_html__( 'اگر این گزینه را تیک بزنید به جای تصویر شاخص پیش فرض دوره تصویر و ویدیو این بخش به جای آن نمایش داده می شود.', $textdomain ),
            'id'   => $perfix . 'rcourse_disable_image',
            'type' => 'checkbox',
            'default' => ''
        ) );

        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'آدرس ویدیو را اضافه کنید', $textdomain ),
            'desc' => esc_html__( 'پشتیبانی از: لینک مستقیم, Youtube لینک, Vimeo لینک.', $textdomain ),
            'id'   => $perfix . 'rcourse_video',
            'type' => 'file',
            'default' => ''
        ) );
    
        $courses_metaboxes->add_field( array(
            'name' => esc_html__( 'پوستر کاور ویدئو', $textdomain ),
            'id'   => $perfix . 'rposter_video_coures',
            'type' => 'file',
            'options' => array(
            'url' => true,
            ),
        ) );

        $courses_group_sessions = $courses_metaboxes->add_field( array(
            'id'          => $perfix.'course_sessions_group',
            'type'        => 'group',
            'description' => __( 'لطفاً بخش یا فصل های درس رو اینجا اضافه کنید', $textdomain ),
            'options'     => array(
                'group_title'       => __( 'سرفصل ها', $textdomain ),
                'add_button'        => __( 'افزودن فصل', $textdomain ),
                'remove_button'     => __( 'حذف فصل', $textdomain ),
                'sortable'          => true,
            ),
        ) );

        $courses_metaboxes->add_group_field( $courses_group_sessions, array(
            'name' => esc_html__( 'عنوان فصل', $textdomain ),
            'id'   => $perfix . 'part_title',
            'type' => 'text',
        ) );

        $courses_metaboxes->add_group_field($courses_group_sessions, array(
            'name' => __('جلسات', $textdomain),
            'id' => $prefix . 'menu_lessons',
            'type' => 'text',
            'repeatable' => true,
            'text' => array(
                    'add_row_text' => 'اضافه کردن جلسات',
               ),
            'desc' => __('عنوان جلسات را اضافه کنید', $textdomain),
      
        ));
        $courses_metaboxes->add_group_field($courses_group_sessions, array(
            'name' => __('لینک دانلود ها', $textdomain),
            'id' => $prefix . 'link_lessons',
            'type' => 'text_url',
            'repeatable' => true,
            'text' => array(
                    'add_row_text' => 'اضافه کردن لینک',
               ),
            'desc' => __('نکته مهم : لینک جلسات رو طبق بخش بالا به ترتیب اضافه کنید یعنی اگر لینک مثلاً شماره 3 را وارد کنید برای عنوان شماره 3 در نظر گرفته می شود.', $textdomain),
      
        ));
        $courses_metaboxes->add_group_field($courses_group_sessions, array(
            'name' => __('زمان ویدیوها', $textdomain),
            'id' => $prefix . 'duration_time_lessons',
            'type' => 'text_small',
            'repeatable' => true,
            'text' => array(
                    'add_row_text' => 'اضافه کردن زمان ویدیو',
               ),
            'desc' => __('نکته مهم : زمان ویدیو هر جلسه رو طبق بخش بالا به ترتیب اضافه کنید یعنی مثلاً اگر زمان ویدیو شماره 3 را تنظیم کنید برای عنوان شماره 3 تنظیم می شود.', $textdomain),
      
        ));
        
    }//end elseif

}
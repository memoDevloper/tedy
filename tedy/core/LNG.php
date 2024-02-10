<?php

class LNG
{

    public $language = array();
    public $langCode = "";
    public $is_rtl = false;
    public $title = "";
    public $dbTitle = array();

    public function __construct($lang)
    {
        $this->is_rtl = $lang == 0 ? true : false;
        $this->langCode = [
            0 => 'ar',
            1 => 'en',
            2 => 'tr'
        ][$lang];
        $this->language = [

            '_SITE_' => ['عيادة اسطنبول - Clinic Of Istanbul', 'Clinic Of Istanbul', 'Clinic Of Istanbul'][$lang],
            '_HOME_TITLE_' => ['عيادة اسطنبول - Clinic Of Istanbul', 'Clinic Of Istanbul', 'Clinic Of Istanbul'][$lang],
            '_DESCRIPTION_' => [
                'مرحبًا بكم في مطعم وكافيه و مخبز تيدي، وهو مطعم ومخبز عائلي يقع في قلب منطقة ينيبوسنا بإسطنبول. منذ عام 2022، قمنا بتقديم أشهى الأطعمة والحلويات لمجتمعنا. شغفنا بالطهي والخبز واضح في كل شيء نقوم به، ونحن نفخر باستخدام أفضل المكونات الطازجة والعالية الجودة في جميع أطباقنا.',
                'Welcome to TEDY, a family-owned cafe and pastry shop located in the heart of Yenibosna, Istanbul. Since 2022, we\'ve been serving up delicious food and pastries to our community. Our passion for cooking and baking is evident in everything we do, and we take pride in using only the freshest and highest quality ingredients in all of our dishes.',
                'Yenibosna, İstanbul\'un kalbinde bulunan aile işletmesi olan TEDY\'ye hoş geldiniz. 2022\'den beri topluluğumuza lezzetli yiyecekler ve pastalar sunuyoruz. Yemek yapma ve pasta yapma tutkumuz, yaptığımız her şeyde açıktır ve tüm yemeklerimizde sadece en taze ve en kaliteli malzemeleri kullanmaktan gurur duyarız.',
            ][$lang],

            // Navbar
            '_HOME_' => ['الرئيسية', 'Home', 'Anasayfa'][$lang],
            '_PRODUCTS_' => ['منتجاتنا', 'Products', 'Ürünler'][$lang],
            '_SERVICES_' => ['الخدمات', 'Services', ''][$lang],
            '_TOURIST_TRAVELS_' => ['رحلات سياحية', 'Toursit Travels', ''][$lang],
            '_HOTEL_RESERVATIONS_' => ['حجوزات فندقية', 'Toursit Travels', ''][$lang],
            '_FLIGHT_RESERVATIONS_' => ['حجوزات طيران', 'Toursit Travels', ''][$lang],
            '_CAR_RENTAL_' => ['تأجير سيارات', 'Toursit Travels', ''][$lang],
            '_ABOUT_US_' => ['من نحن', 'About Us', 'Hakkımızda'][$lang],
            '_MENU_' => ['القائمة', 'Menu', 'Menü'][$lang],
            '_MENU_DESC_' => [
                'في تيدي، نقدم مجموعة واسعة من الأطباق والحلويات لتناسب كل ذوق. تتضمن قائمتنا الأطباق التركية الكلاسيكية مثل الكفتة والبقلاوة، بالإضافة إلى المفضلات الدولية مثل البيتزا والكرواسون. نستخدم وصفات تقليدية بلمسة عصرية، مما يؤدي إلى نكهات فريدة ولذيذة ستجعلك تعود مرة أخرى.',
                'At TEDY, we offer a wide range of dishes and pastries to suit every taste. Our menu includes Turkish classics like kofte and baklava, as well as international favorites like pizza and croissants. We use traditional recipes with a modern twist, resulting in unique and delicious flavors that will keep you coming back for more.',
                'TEDY\'de her zevke uygun geniş bir yelpazede yemek ve pasta sunuyoruz. Menümüz, köfte ve baklava gibi Türk klasiklerinin yanı sıra pizza ve kruvasan gibi uluslararası favorileri içerir. Geleneksel tariflerimizi modern bir dokunuşla kullanıyoruz, sonuçta sizi daha fazlası için geri getirecek benzersiz ve lezzetli tatlar oluşturuyoruz.'
            ][$lang],
            '_BLOG_' => ['المدونة', 'Blog', ''][$lang],
            '_REAL_ESTATES_' => ['العقارات', 'Real Esates', ''][$lang],
            '_LATEST_NEWS_' => ['آخر الأخبار', 'Latest News', ''][$lang],
            '_TURKISH_CITIZENSHIP_' => ['الجنسية التركية', 'Turkish Citizenship', 'Türk Vatandaşlığı'][$lang],
            '_REAL_ESTATE_PROJECTS_' => ['المشاريع العقارية', 'Real estate Projects', 'Gayrimenkul Projeleri'][$lang],
            '_CONTACT_US_' => ['اتصل بنا', 'Contact us', 'İletişim'][$lang],
            '_TESTIMONIALS_' => ['توصيات عملاءنا', 'Testimonials', 'Referanslar'][$lang],
            '_BLOG_' => ['المدونة', 'Blog', 'Blog'][$lang],
            '_CHOSEN_AREAS_' => ['مناطق مختارة', 'Chosen Area', ''][$lang],
            '_HEALTH_TOURISM_' => ['السياحة العلاجية', 'Health Toursim', 'sağlık turizmi'][$lang],

            '_WE_OFFER_TOP_NOTCH_' => ['نقدم أفضل الخدمات', 'We Offer Top Notch', 'En İyi Hizmeti Sunuyoruz'][$lang],
            '_FLAVORS_FOR_ROYALTY_' => ['نكهات للملوك', 'Flavors For Royalty', 'Kraliyet İçin Lezzetler'][$lang],
            '_BOOKING_REQUEST_' => ['طلب حجز', 'Booking Request', 'Rezervasyon Talebi'][$lang],

            // Cities
            '_TOURISTIC_AREAS_' => ['المناطق السياحية', 'Touristic Areas'][$lang],
            '_ISTANBUL_CITY_' => ['مدينة اسطنبول', 'Istanbul City'][$lang],
            '_YALOVA_CITY_' => ['مدينة يالوفا', 'Yalova City'][$lang],
            '_BURSA_CITY_' => ['مدينة بورصا', 'Bursa City'][$lang],
            '_TRABZON_CITY_' => ['مدينة طرابزون', 'Trabzon City'][$lang],
            '_RIZE_CITY_' => ['مدينة ريزة', 'Rize City'][$lang],
            '_ABANT_CITY_' => ['مدينة أبانت', 'Abant City'][$lang],
            '_SAFRAN_BOLU_CITY_' => ['مدينة صفران بولو', 'Safran Bolu City'][$lang],
            '_SABANCA_AND_MAASHOUQIAH_CITY_' => ['صبنجة ومعشوقية', 'Sabanca and Ma\'ashouqiah'][$lang],
            '_CAPPADOCIA_CITY_' => ['مدينة كبادوكيا', 'Cappadocia City'][$lang],
            '_BARTIN_CITY_' => ['مدينة بارتين', 'Bartin City'][$lang],
            '_SAMSUN_CITY_' => ['مدينة سامسون', 'Samsun City'][$lang],
            '_ORDU_CITY_' => ['مدينة أوردو', 'Ordu City'][$lang],
            '_KAYSERI_CITY_' => ['مدينة قيصري', 'Kayseri City'][$lang],
            '_MUGLA_CITY_' => ['مدينة موغلا', 'Mugla City'][$lang],
            '_ANTALYA_CITY_' => ['مدينة أنطاليا', 'Antalya City'][$lang],
            '_ANTAKYA_CITY_' => ['مدينة أنطاكيا', 'Antakya City'][$lang],
            '_IZMIR_CITY_' => ['مدينة إزمير', 'Izmir City'][$lang],
            '_BALIK_ESER_CITY_' => ['مدينة باليك إسير', 'Balik Eser City'][$lang],

            // Search
            '_FIND_YOUR_PROPERTY_' => ['ابحث عن عقارك', 'Find Your Property', 'Mülkünüzü Bulun'][$lang],
            '_FIND_YOUR_PROPERTY_DESC_' => [
                'ابحث عن عقارك المناسب والذي يمَّكنك من الحصول على الجنسية التركية عند تملكه',
                'Find your appropriate Property that allows you obtaining the Turkish citizenship',
                'Türk vatandaşlığını almanıza izin veren uygun Mülkü bulun'
            ][$lang],
            '_READ_MORE_' => ['المزيد', 'Read More', 'Daha Fazla'][$lang],
            '_MORE_' => ['المزيد', 'More', 'Daha Fazla'][$lang],

            // Projects
            '_SUITABLE_FOR_ACQUIRING_TURKISH_CITIZENSHIP_' => [
                'مناسب للحصول على الجنسية',
                'Suitable for acquiring Turkish citizenship',
                'Türk vatandaşlığı almaya uygun'
            ][$lang],
            '_FEATURED_PROJECT_' => [
                'مشروع مميز',
                'Featured Project',
                'Öne Çıkan Proje'
            ][$lang],

            // Languages
            '_LANGUAGE_' => ['اللغة', 'Language', 'Dil'][$lang],
            '_ARABIC_' => ['العربية', 'العربية', 'العربية'][$lang],
            '_ENGLISH_' => ['English', 'English', 'English'][$lang],
            '_TURKISH_' => ['Türkçe', 'Türkçe', 'Türkçe'][$lang],

            // Contacts
            '_CONTACT_DESC_' => ['لا تتردد بالتواصل معنا، سنكون سعداء بخدمتكم', 'Feel free to contact us, we would be happy to help you', 'Bizimle iletişime geçmekten çekinmeyin, size yardımcı olmaktan mutluluk duyarız'][$lang],
            '_CONTACT_INFO_' => ['معلومات التواصل', 'Contact Info', 'İletişim Bilgileri'][$lang],
            '_NAME_' => ['الاسم', 'Name', 'Ad'][$lang],
            '_EMAIL_' => ['البريد الإلكتروني', 'Email', 'E-posta'][$lang],
            '_PHONE_' => ['رقم الهاتف', 'Phone', 'Cep numarası'][$lang],
            '_FAX_' => ['فاكس', 'Fax', 'Fax'][$lang],
            '_SEND_' => ['إرسال', 'Send', 'Gönder'][$lang],
            '_SUBJECT_' => ['الموضوع', 'Subject', 'Konu'][$lang],
            '_MESSAGE_' => ['الرسالة', 'Message', 'Mesaj'][$lang],
            '_WRITE_MESSAGE_' => ['اكتب رسالة', 'Write Message', 'Mesaj Yazın'][$lang],
            '_ASK_FOR_SPECIAL_OFFER_' => [
                'اطلب عرضاً خاصاً',
                'Ask For Special Offer',
                'Özel Teklif İsteyin'
            ][$lang],
            '_WHATSAPP_' => [
                'واتسآب',
                'Whatsapp',
                'Whatsapp',
            ][$lang],

            // Project
            '_FEATURED_PROJECTS_' => ['مشاريع مميزة', 'Featured Projects', 'Öne Çıkan Projeler'][$lang],
            '_QUICK_SUMMARY_' => ['تفاصيل سريعة', 'Quick Summary', 'Hızlı özet'][$lang],
            '_EXTERIOR_IMAGES_' => ['الصور الخارجية', 'Exterior Images', 'Dış Mekan Görselleri'][$lang],
            '_INTERIOR_IMAGES_' => ['الصور الداخلية', 'Interior Images', 'İç Mekan Görselleri'][$lang],
            '_SCHEME_IMAGES_' => ['صور المخطط', 'Scheme Images', 'Şema görüntüleri'][$lang],
            '_AREA_' => ['المساحة', 'Area', 'Alan'][$lang],
            '_AREA_UNIT_' => ['م', 'm', 'm'][$lang],
            '_CITY_' => ['المدينة', 'City', 'İl'][$lang],
            '_DISTRICT_' => ['المنطقة', 'District', 'İlçe'][$lang],
            '_BUILDINGS_NUMBER_' => ['عدد الأبنية', 'Buildings', 'Bina Sayısı'][$lang],
            '_PROPERTIES_NUMBER_' => ['عدد العقارات', 'Properties', 'Konut Sayısı'][$lang],
            '_STARTING_PRICE_' => ['السعر الابتدائي', 'Starting Price', 'Başlangıç Fiyatı'][$lang],
            '_STARTING_AREA_' => ['المساحة الابتدائية', 'Starting Area', 'Başlangıç Alanı'][$lang],
            '_DUES_' => ['العائدات', 'Deus', 'Aidat'][$lang],
            '_HEATING_' => ['التدفئة', 'Heating', 'Isıtma'][$lang],
            '_STOVE_' => ['مدفأة', 'Stove', 'Soba'][$lang],
            '_GAS_STOVE_' => ['مدفأة غاز', 'Gas Stove', 'Gaz Sobası'][$lang],
            '_CENTRAL_' => ['تدفئة مركزية', 'Central', 'Merkezi'][$lang],
            '_COMBI_BOILER_' => ['غاز (كومبي)', 'Combi Boiler', 'Doğalgaz (Kobmi)'][$lang],
            '_FLOOR_HEATING_' => ['تدفئة أرضية', 'Floor Heating', 'Yerden Isıtma'][$lang],
            '_AIR_CONDITIONER_' => ['مكيف هواء', 'Air Conditioner', 'Klima'][$lang],
            '_FAN_COIL_CONDITIONER_' => ['مكيف سقفي', 'Fan Coil Conditioner', 'Fancoil Ünitesi'][$lang],
            '_SOLAR_POWER_' => ['طاقة شمسية', 'Solar Power', 'Güneş Enerjisi'][$lang],
            '_GEOTHERMAL_' => ['تدفئة أرضية', 'Geothermal', 'Jeotermal'][$lang],
            '_UNKNOWN_' => ['غير معروف', 'Unknown', 'Bilinmeyen'][$lang],
            '_COMPOUND_DESCRIPTION_' => ['وصف المجمع', 'Compound Description', 'Site Açıklaması'][$lang],
            '_COMPOUND_FEATURES_' => ['مزايا المجمع', 'Compound Features', 'Site Özellikleri'][$lang],
            '_SEARCH_' => ['بحث', 'Search', 'Ara'][$lang],
            '_PRICE_FROM_' => ['السعر: من', 'Price: from', 'Fiyatın başlangıç'][$lang],
            '_PRICE_TO_' => ['السعر: إلى', 'Price: to', 'Fiyatın sonu'][$lang],
            '_ROOMS_' => ['عدد الغرف', 'Rooms', 'Oda Sayısı'][$lang],
            '_PRICE_' => ['السعر', 'Price', 'Fiyat'][$lang],
            '_AREA_FROM_' => ['المساحة: من', 'Area: from', 'Alanın başlangıç'][$lang],
            '_AREA_TO_' => ['المساحة: إلى', 'Area: to', 'Alanın sonu'][$lang],
            '_KEY_WORD_' => ['كلمة مفتاحية', 'Key Word', 'Anahtar Kelmesi'][$lang],
            '_REAL_ESTATES_TYPES_' => ['أنواع العقارات', 'Real Estates Types', 'Gayrimenkul Tipleri'][$lang],
            '_ROOMS_UNDEFINED_' => ['عدد الغرف غير محدد', 'Rooms Number Undefined', 'Oda Sayısı Belirtmemiş'][$lang],

            // Turkish Citizenship

            '_ACQUIRE_THE_TURKISH_CITIZENSHIP_' => [
                'الحصول على الجنسية التركية',
                'Acquire Turkish citizenship',
                'Türk vatandaşlığını kazanması'
            ][$lang],
            '_ACQUIRE_THE_TURKISH_CITIZENSHIP_SEO_TITLE_' => [
                'تعرف على أفضل الطرق وأضمنها للحصول على الجنسية التركية',
                'Learn about the best and surest ways to acquire Turkish citizenship',
                'Türk vatandaşlığı almanın en iyi ve en kesin yollarını öğrenin'
            ][$lang],

            // Our Team
            '_OUR_STAFF_' => ['كادر العمل', 'Our Staff', 'Kadromuz'][$lang],
            '_OUR_STAFF_DESC_' => [
                'لا تتردد في التواصل مع كادرنا للحصول على المشورة',
                'Feel free to communicate with our staff to get your advice',
                'Tavsiyenizi almak için kadromuzla iletişim kurmaktan çekinmeyin'
            ][$lang],

            // Currencies
            '_CURRENCY_' => ['العملة', 'Currency', 'Para birimi'][$lang],
            '_USD_' => ['دولار', 'Dollar', 'Dolar'][$lang],
            '_EUR_' => ['يورو', 'Euro', 'Avro'][$lang],
            '_TRY_' => ['ليرة تركية', 'Turkish Lira', 'TL'][$lang],
            '_SAR_' => ['ريال سعودي', 'Saudi Riyal', 'Suudi Arabistan Riyali'][$lang],
            '_AED_' => ['دهم إماراتي', 'United Arab Emirates dirham', 'Birleşik Arap Emirlikleri Dirhemi'][$lang],
            '_KWD_' => ['دينار كويتي', 'Kuwaiti dinar', 'Kuveyt Dinarı'][$lang],
            '_OMR_' => ['ريال عماني', 'Omani Rial', 'Umman riyali'][$lang],
            '_QAR_' => ['ريال قطري', 'Qatari Riyal', 'Katar Riyali'][$lang],
            '_BHD_' => ['دينار بحريني', 'Bahraini dinar', 'Bahreyn Dinarı'][$lang],
            '_JOD_' => ['دينار أردني', 'Jordanian dinar', 'Bahreyn dinarı'][$lang],
            '_DZD_' => ['دينار جزائري', 'Algerian Dinar', 'Cezayir dinarı'][$lang],
            '_YER_' => ['ريال يمني', 'Yemeni Rial', 'Yemen Riyali'][$lang],
            '_GBP_' => ['جنيه استرليني', 'Pound sterling', 'İngiliz sterlini'][$lang],
            '_CHF_' => ['فرنك سويسري', 'Swiss Franc', 'İsviçre Frangı'][$lang],
            '_CAD_' => ['دولار كندي', 'Canadian dollar', 'Kanada Doları'][$lang],
            '_AUD_' => ['دولار أسترالي', 'Australian Dollar', 'Avustralya doları'][$lang],
            '_CNY_' => ['يوان صيني', 'Chinese Yuan', 'Çin Yuanı'][$lang],
            '_RUB_' => ['روبل روسي', 'Russian ruble', 'Rus Rublesi'][$lang],

            // Days
            '_MONDAY_' => ['الإثنين'],
            '_TUESDAY_' => ['الثلاثاء'],
            '_WEDNESDAY_' => ['الأربعاء'],
            '_THURSDAY_' => ['الخميس'],
            '_FRIDAY_' => ['الجمعة'],
            '_SATURDAY_' => ['السبت'],
            '_SUNDAY_' => ['الأحد'],

            //
            '_ALRAWI_GROUP_' => ['مجموعة الراوي', 'Alrawi Group', 'Alrawi Grubu'][$lang],
            '_YES_' => ['نعم', 'Yes', 'Evet'][$lang],
            '_NO_' => ['لا', 'No', 'Hayır'][$lang],
            '_SOLD_PROJECT_LONG_' => ['هذا المشروع مباع بالكامل', 'This project is totally sold', 'Bu proje tamamen satıldı'][$lang],
            '_THE_STEPS_OF_ACQUIRING_THE_TURKISH_CITIZENSHIP_SEO_TITLE_' => ['مراحل الحصول على الجنسية التركية', 'The steps of acquiring Turkish citizenship', 'Türkiye vatandaşlığı kazanma adımları'][$lang],
            '_DELIVERY_DATE_' => ['تاريخ تسليم المشروع', 'Delivery Date', 'Teslim Tarihi'][$lang],
            '_IMMEDIATELY_' => ['فوري', 'Immediately', 'Hemen'][$lang],
            '_FACILITIES_IMAGES_' => ['صور المرفقات', 'Facilities Images', 'Tesisler Görselleri'][$lang],
            '_SEE_ALL_PROJECTS_' => ['مشاهدة جميع المشاريع', 'See All Projects', ''][$lang],
            '_COPY_RIGHTS_' => ['جميع الحقوق محفوظة', 'All rights reserved', ''][$lang],
            '_ALRAWI_COMPANY_' => [
                'تصميم وتنفيذ شركة <a href="https://alawsetmedia.com" target="_blank">الأوسط ميديا</a>',
                'Desigend and Developed by <a href="https://alawsetmedia.com" target="_blank">Alawset Media</a> company',
                ''
            ][$lang],
        ];

        $this->dbTitle = [
            'name' => ['name_ar', 'name_en', 'name_tr'][$lang],
            'desc' => ['desc_ar', 'desc_en', 'desc_tr'][$lang],
        ];
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}

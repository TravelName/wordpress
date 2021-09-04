<?php
/**
 * WordPress için başlangıç ayar dosyası.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * Bu dosya şu ayarları içerir:
 * 
 * * MySQL ayarları
 * * Gizli anahtarlar
 * * Veritabanı tablo ön eki
 * * ABSPATH
 * 
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL ayarları - Bu bilgileri servis sağlayıcınızdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define( 'DB_NAME', 'wordpress_db' );

/** MySQL veritabanı kullanıcısı */
define( 'DB_USER', 'root' );

/** MySQL veritabanı parolası */
define( 'DB_PASSWORD', '' );

/** MySQL sunucusu */
define( 'DB_HOST', 'localhost' );

/** Yaratılacak tablolar için veritabanı karakter seti. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define( 'DB_COLLATE', '' );

/**#@+
 * Eşsiz doğrulama anahtarları ve tuzlar.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7W0Fq];AI*z{UrVI2Ksnp*kYq6/E.YcP3*qhF-$_DCsRlSh |z^mT]`7>gD-^U:&' );
define( 'SECURE_AUTH_KEY',  '9I:sIT.*ZjTI=|<Hs4f0QiTZ<7Dlx62+na#_9]W#VU^e>3k_tXp}{K[&c`LI:+89' );
define( 'LOGGED_IN_KEY',    'xYP1%~@xvGDdRHtJY0vFmxWeXp43-C0T#h?*-yYpuJ#n:3?zV.Du8D> iz<{XZXV' );
define( 'NONCE_KEY',        'ZsS?4iC1ObV@GHd=Q]R+UZPp{`Esqq4K~MfmVK`s|9B{s|>ukqmp4Z4CeZ-W&?gw' );
define( 'AUTH_SALT',        '{X^Hm[z^s$4snrt//>lLof!C`Q}pt<$vxj|Mv[V(7}QU`]ZXVb=[depmMUKN.Y($' );
define( 'SECURE_AUTH_SALT', '(md:n`taCjjr[7B*g.ej/` VfHaC8x_6FL[Nd.x2riAp-<ScV|5jUoP.YU(J:oSp' );
define( 'LOGGED_IN_SALT',   'gQIs(sO}~H|/iR`9PS4*(]hHVJ#yW[7>RhVvU)7B%c=NH*;WgzIXVYK@# n0&u~z' );
define( 'NONCE_SALT',       'a*`%c58vwd.kh[0E2cQh-4Q*w3:>zcR})5f%Q%pHYPqw?Cjp3`9%a${pp,u=2o_,' );

/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix = 'wp_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri "true" yaparak geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 * 
 * Hata ayıklama için kullanabilecek diğer sabitler ile ilgili daha fazla bilgiyi
 * belgelerden edinebilirsiniz.
 * 
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** WordPress değişkenlerini ve yollarını kurar. */
require_once ABSPATH . 'wp-settings.php';
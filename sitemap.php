<?php
    header('Content-type: application/xml');
    echo "<?xml version='1.0' encoding='UTF-8'?>"."\n";
    echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>"."\n";

    $lastmod = date('Y-m-d\TH:i:s+00:00');

    echo "<url>";
    echo "<loc>http://localhost/mailing/auth.php</loc>";
    echo "<lastmod>$lastmod</lastmod>";
    echo "<priority>1.00</priority>";
    echo "</url>";

    echo "<url>";
    echo "<loc>http://localhost/mailing/dashboard.php</loc>";
    echo "<lastmod>$lastmod</lastmod>";
    echo "<priority>1.00</priority>";
    echo "</url>";

    echo "</urlset>";
?>
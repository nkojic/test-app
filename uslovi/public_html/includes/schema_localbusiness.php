<?php
$schema = [
  "@context" => "https://schema.org",
  "@type" => "HealthAndBeautyBusiness",
  "name" => "Bowen centar",
  "url" => "https://bowencentar.rs",
  "logo" => "https://bowencentar.rs/images/logo.png",
  "image" => "https://bowencentar.rs/images/logo.png",

  "email" => "office@bowencentar.rs",
  "telephone" => "+381641112202",

  "address" => [
    "@type" => "PostalAddress",
    "streetAddress" => "Dobropoljska 35",
    "addressLocality" => "Beograd",
    "postalCode" => "14000",
    "addressCountry" => "RS"
  ],

  "geo" => [
    "@type" => "GeoCoordinates",
    "latitude" => 44.79281710846598,
    "longitude" => 20.46253608465882
  ],

  "openingHoursSpecification" => [
    [
      "@type" => "OpeningHoursSpecification",
      "dayOfWeek" => ["Monday","Tuesday","Wednesday","Thursday","Friday"],
      "opens" => "10:00",
      "closes" => "20:00"
    ],
    [
      "@type" => "OpeningHoursSpecification",
      "dayOfWeek" => "Saturday",
      "opens" => "10:00",
      "closes" => "14:00"
    ]
  ],

  "sameAs" => [
    "https://www.instagram.com/ovdeisada_/",
    "https://www.facebook.com/ovdeisada"
  ]
];

echo '<script type="application/ld+json">'
     . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
     . '</script>';
?>
<?php

class Resource {
  

    /**
     * @uses testimonial::function use for testimonial components.
     * @return array with all testimonials related data.
     */
    public static function testimonial()
    {
        $site_items = StaticSiteItem::select('testimonial_title', 'testimonial_image')->first();
        $testimonials = Testimonial::latest('serial')->get();

        return [
            'testimonials' => $testimonials,
            'testimonial_title' => $site_items['testimonial_title'],
            'testimonial_image' => asset($site_items['testimonial_image']),
        ];
    }

    public static function siteItems(string $selector){
        return StaticSiteItem::select($selector)->first()->$selector;
    }
}
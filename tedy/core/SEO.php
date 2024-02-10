<?php

class SEO
{

    private $seoElements = array();
    private $keywordsSet = array();
    private $ldJson = array();
    public $title;
    public $description;
    public $keywords = "";
    public $image;
    public $ogType = "website";

    public function __construct($name, $logo, $url, $socialAccounts, $description)
    {
        $this->ldJson['@context'] = 'https://schema.org';
        $this->ldJson['@graph'][] = [
            '@type' => 'Organization',
            '@id' => "$url/#organization",
            'name' => $name,
            'url' => $url,
            'sameAs' => $socialAccounts,
            'logo' => [
                '@type' => 'ImageObject',
                '@id' => "$url/#logo",
                'inLanguage' => 'en-US',
                'url' => $logo,
                'caption' => $name
            ],
            'image' => [
                '@id' => "$url/#logo"
            ]
        ];
        $this->ldJson['@graph'][] = [
            '@type' => 'WebSite',
            '@id' => "$url/#website",
            'url' => $url,
            'name' => $name,
            'description' => $description,
            'publisher' => [
                '@id' => "$url/#organization"
            ],
            'inLanguage' => 'en-US'
        ];
        $this->ldJson['@graph'][] = [
            '@type' => 'Person',
            '@id' => "$url/#/schema/person",
            'name' => "admin",
            'sameAs' => [
                "$url"
            ]
        ];
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function setDescription($description)
    {
        $this->description = $description;
        $this->seoElements[] = "<meta name=\"description\" content=\"$description\" />";
        $this->seoElements[] = "<meta property=\"og:description\" content=\"$description\" />";
    }

    public function setImage($image)
    {
        $this->image = $image;
        $this->seoElements[] = "<meta name=\"image\" content=\"$image\" />";
        $this->seoElements[] = "<meta property=\"og:image\" content=\"$image\" />";
    }

    public function setType($type)
    {
        $this->ogType = $type;
    }

    public function setKeyword($keywords)
    {
        if (is_array($keywords)) {
            foreach ($keywords as $keyword) {
                $this->keywordsSet[] = $keyword;
                $this->keywords .= $keyword . ", ";
            }
        } else {
            $this->keywordsSet[] = $keywords;
            $this->keywords .= $keywords . ", ";
        }
    }

    public function setLdJsonGraph($graph)
    {
        $this->ldJson['@graph'][] = $graph;
    }

    public function setOgMeta(array $arr)
    {
        $meta = "<meta ";
        if (isset($arr['name'])) {
            $meta .= "name=\"$arr[name]\"";
        }
        if (isset($arr['property'])) {
            $meta .= "property=\"$arr[property]\"";
        }
        if (isset($arr['content'])) {
            $meta .= "content=\"$arr[content]\"";
        }
        $meta .= " />";
        $this->seoElements[] = $meta;
    }

    public function seo()
    {
        if (!empty($this->keywordsSet)) {
            $keywords = "";
            foreach ($this->keywordsSet as $keyword) {
                $keywords .= $keyword . ", ";
            }
            $this->setOgMeta([
                'name' => 'keywords',
                'content' => $keywords
            ]);
        }
        $ldJson = json_encode($this->ldJson);
        $this->seoElements[] = "<script type=\"application/ld+json\" class=\"yoast-schema-graph\">$ldJson</script>";
        $this->seoElements[] = "<meta property=\"og:type\" content=\"$this->ogType\" />";
        foreach ($this->seoElements as $seoElement) {
            echo $seoElement;
        }
    }
}

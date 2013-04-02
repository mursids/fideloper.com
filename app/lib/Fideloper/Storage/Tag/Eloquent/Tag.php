<?php namespace Fideloper\Storage\Tag\Eloquent;

use Fideloper\Storage\Tag\TagInterface;

class Tag implements TagInterface {

    protected $tag;

    public function __construct()
    {
        $this->tag = new \Tag;

    }

    public function getPopular($limit=8)
    {
        return \DB::table('tags_articles')->select('name', 'url_name', 'tag_id', \DB::raw('count(`tag_id`) as `tag_count`'))
                                        ->join('tags', 'tags.id', '=', 'tags_articles.tag_id')
                                        ->groupBy('tag_id')
                                        ->orderBy('tag_count', 'DESC')
                                        ->take($limit)
                                        ->get();
    }

    public function getEtag()
    {
        return $this->tag->getEtag();
    }

}
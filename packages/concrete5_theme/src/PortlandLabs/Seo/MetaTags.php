<?php
namespace PortlandLabs\Seo;

use Concrete\Core\Page\Collection\Collection;
use Concrete\Core\Url\Resolver\Manager\ResolverManagerInterface;

class MetaTags
{

    /** @var \Concrete\Core\Page\Collection\Collection  */
    private $collection;
    /**
     * @var \Concrete\Core\Url\Resolver\Manager\ResolverManagerInterface
     */
    private $resolver;

    public function __construct(Collection $c, ResolverManagerInterface $resolver)
    {
        $this->collection = $c;
        $this->resolver = $resolver;
    }

    public function getTags()
    {
        $url = $this->resolver->resolve(array($this->collection));
        $tags = array(
            'fb:profile_id' => '244758055571618',
            'twitter:card' => 'summary',
            'twitter:site' => '@concrete5',
            'twitter:url' => $url,
            'og:site_name' => 'concrete5.org',
            'og:type' => 'article',
            'og:url' => $url
        );

        $tags = $this->getTitleTags($tags);
        $tags = $this->getDescriptionTags($tags);
        $tags = $this->getImageTags($tags);

        return $tags;
    }

    /**
     * @param $tags
     * @return array
     */
    private function getTitleTags($tags)
    {
        if ($title = $this->collection->getAttribute('meta_title')) {
            $sanitized = preg_replace('/\s\s+/', ' ', $title);
            $tags['twitter:title'] = $sanitized;
            $tags['og:title'] = $sanitized;
            $tags['name'] = $sanitized;
            return $tags;
        }
        return $tags;
    }

    /**
     * @param $tags
     * @return array
     */
    private function getDescriptionTags($tags)
    {
        if ($description = $this->collection->getAttribute('meta_description')) {
            $tags['twitter:description'] = $description;
            $tags['og:description'] = $description;
            return $tags;
        }
        return $tags;
    }

    /**
     * @param $tags
     * @return array
     */
    private function getImageTags($tags)
    {
        /** @var \Concrete\Core\File\File $thumbnail */
        if ($thumbnail = $this->collection->getAttribute('thumbnail')) {
            $url = $thumbnail->getVersion()->getUrl();
            $tags['twitter:image'] = $url;
            $tags['og:image'] = $url;
            $tags['image'] = $url;
            return $tags;
        }
        return $tags;
    }

    public function outputTags()
    {
        foreach ($this->getTags() as $key => $value) {
            echo '<meta property="' . $key . '" content="' . h($value) . '" />';
        }
    }

}

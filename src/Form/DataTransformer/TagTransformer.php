<?php
// src/Form/DataTransformer/IssueToNumberTransformer.php
namespace App\Form\DataTransformer;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagTransformer implements DataTransformerInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private TagRepository $tagRepository,
    ) {
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     */
    public function transform($value): string
    {
        if (null === $value) {
            return '';
        }

        $array = [];
        foreach ($value as $tag) {
            $array[] = $tag->getName();
        }

        return implode(',', $array);
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $issueNumber
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform(mixed $value = null): ?ArrayCollection
    {

        if (!$value) {
            return null;
        }

        $items = explode(",", $value);
        $items = array_map('trim', $items);
        $items = array_unique($items);

        $tags = new ArrayCollection();

        foreach ($items as $item) {
            $tag = (new Tag())->setName($item);
            $tags->add($tag);
        }

        return $tags;
    }
}

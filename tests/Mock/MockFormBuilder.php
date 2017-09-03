<?php
declare(strict_types=1);

namespace Tests\Mock;

use Iterator;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormConfigInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\Form\ResolvedFormTypeInterface;
use Symfony\Component\PropertyAccess\PropertyPathInterface;

/**
 * Class MockFormBuilder
 * @package Tests\Mock
 */
class MockFormBuilder implements FormBuilderInterface, Iterator
{
    /**
     * @param int|string|FormBuilderInterface $child
     * @param null                            $type
     * @param array                           $options
     *
     * @return MockFormBuilder
     */
    public function add($child, $type = null, array $options = []): self
    {
        return $this;
    }

    /**
     * @param string $name
     * @param null   $type
     * @param array  $options
     *
     * @return MockFormBuilder
     */
    public function create($name, $type = null, array $options = []): self
    {
        return $this;
    }

    /**
     * @param string $name
     *
     * @return MockFormBuilder
     */
    public function get($name): self
    {
        return $this;
    }

    /**
     * @param string $name
     *
     * @return MockFormBuilder
     */
    public function remove($name): self
    {
        return $this;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name): bool
    {
        return false;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return [];
    }

    /**
     * @return null|FormInterface
     */
    public function getForm(): ?FormInterface
    {
        return null;
    }

    /**
     * @param string   $eventName
     * @param callable $listener
     * @param int      $priority
     *
     * @return MockFormBuilder
     */
    public function addEventListener($eventName, $listener, $priority = 0): self
    {
        return $this;
    }

    /**
     * @param EventSubscriberInterface $subscriber
     *
     * @return MockFormBuilder
     */
    public function addEventSubscriber(EventSubscriberInterface $subscriber): self
    {
        return $this;
    }

    /**
     * @param DataTransformerInterface $viewTransformer
     * @param bool                     $forcePrepend
     *
     * @return MockFormBuilder
     */
    public function addViewTransformer(DataTransformerInterface $viewTransformer, $forcePrepend = false): self
    {
        return $this;
    }

    /**
     * @return MockFormBuilder
     */
    public function resetViewTransformers(): self
    {
        return $this;
    }

    /**
     * @param DataTransformerInterface $modelTransformer
     * @param bool                     $forceAppend
     *
     * @return MockFormBuilder
     */
    public function addModelTransformer(DataTransformerInterface $modelTransformer, $forceAppend = false): self
    {
        return $this;
    }

    /**
     * @return MockFormBuilder
     */
    public function resetModelTransformers(): self
    {
        return $this;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return MockFormBuilder
     */
    public function setAttribute($name, $value): self
    {
        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return MockFormBuilder
     */
    public function setAttributes(array $attributes): self
    {
        return $this;
    }

    /**
     * @param DataMapperInterface|null $dataMapper
     *
     * @return MockFormBuilder
     */
    public function setDataMapper(DataMapperInterface $dataMapper = null): self
    {
        return $this;
    }

    /**
     * @param bool $disabled
     *
     * @return MockFormBuilder
     */
    public function setDisabled($disabled): self
    {
        return $this;
    }

    /**
     * @param mixed $emptyData
     *
     * @return MockFormBuilder
     */
    public function setEmptyData($emptyData): self
    {
        return $this;
    }

    /**
     * @param bool $errorBubbling
     *
     * @return MockFormBuilder
     */
    public function setErrorBubbling($errorBubbling): self
    {
        return $this;
    }

    /**
     * @param bool $required
     *
     * @return MockFormBuilder
     */
    public function setRequired($required): self
    {
        return $this;
    }

    /**
     * @param null|string|PropertyPathInterface $propertyPath
     *
     * @return MockFormBuilder
     */
    public function setPropertyPath($propertyPath): self
    {
        return $this;
    }

    /**
     * @param bool $mapped
     *
     * @return MockFormBuilder
     */
    public function setMapped($mapped): self
    {
        return $this;
    }

    /**
     * @param bool $byReference
     *
     * @return MockFormBuilder
     */
    public function setByReference($byReference): self
    {
        return $this;
    }

    /**
     * @param bool $inheritData
     *
     * @return MockFormBuilder
     */
    public function setInheritData($inheritData): self
    {
        return $this;
    }

    /**
     * @param bool $compound
     *
     * @return MockFormBuilder
     */
    public function setCompound($compound): self
    {
        return $this;
    }

    /**
     * @param ResolvedFormTypeInterface $type
     *
     * @return MockFormBuilder
     */
    public function setType(ResolvedFormTypeInterface $type): self
    {
        return $this;
    }

    /**
     * @param mixed $data
     *
     * @return MockFormBuilder
     */
    public function setData($data): self
    {
        return $this;
    }

    /**
     * @param bool $locked
     *
     * @return MockFormBuilder
     */
    public function setDataLocked($locked): self
    {
        return $this;
    }

    /**
     * @param FormFactoryInterface $formFactory
     *
     * @return MockFormBuilder
     */
    public function setFormFactory(FormFactoryInterface $formFactory): self
    {
        return $this;
    }

    /**
     * @param string $action
     *
     * @return MockFormBuilder
     */
    public function setAction($action): self
    {
        return $this;
    }

    /**
     * @param string $method
     *
     * @return MockFormBuilder
     */
    public function setMethod($method): self
    {
        return $this;
    }

    /**
     * @param RequestHandlerInterface $requestHandler
     *
     * @return MockFormBuilder
     */
    public function setRequestHandler(RequestHandlerInterface $requestHandler): self
    {
        return $this;
    }

    /**
     * @param bool $initialize
     *
     * @return MockFormBuilder
     */
    public function setAutoInitialize($initialize): self
    {
        return $this;
    }

    /**
     * @return null|FormConfigInterface
     */
    public function getFormConfig(): ?FormConfigInterface
    {
        return null;
    }

    /**
     * @return null|EventDispatcherInterface
     */
    public function getEventDispatcher(): ?EventDispatcherInterface
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return null;
    }

    /**
     * @return null|PropertyPathInterface
     */
    public function getPropertyPath(): ?PropertyPathInterface
    {
        return null;
    }

    /**
     * @return bool
     */
    public function getMapped(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getByReference(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getInheritData(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getCompound(): bool
    {
        return false;
    }

    /**
     * @return null|ResolvedFormTypeInterface
     */
    public function getType(): ?ResolvedFormTypeInterface
    {
        return null;
    }

    /**
     * @return array
     */
    public function getViewTransformers(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getModelTransformers(): array
    {
        return [];
    }

    /**
     * @return null|DataMapperInterface
     */
    public function getDataMapper(): ?DataMapperInterface
    {
        return null;
    }

    /**
     * @return bool
     */
    public function getRequired(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getDisabled(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getErrorBubbling(): bool
    {
        return false;
    }

    public function getEmptyData(): void
    {
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasAttribute($name): bool
    {
        return false;
    }

    /**
     * @param string $name
     * @param null   $default
     */
    public function getAttribute($name, $default = null): void
    {
    }

    public function getData(): void
    {
    }

    /**
     * @return null|string
     */
    public function getDataClass(): ?string
    {
        return null;
    }

    /**
     * @return bool
     */
    public function getDataLocked(): bool
    {
        return false;
    }

    /**
     * @return null|FormFactoryInterface
     */
    public function getFormFactory(): ?FormFactoryInterface
    {
        return null;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return 'http://127.0.0.1';
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    public function getRequestHandler(): void
    {
    }

    /**
     * @return bool
     */
    public function getAutoInitialize(): bool
    {
        return false;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasOption($name): bool
    {
        return false;
    }

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        return null;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return 0;
    }

    public function getIterator()
    {
    }

    /**
     * @return int
     */
    public function current(): int
    {
        return 0;
    }

    public function next(): void
    {
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return 0;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return false;
    }

    public function rewind()
    {
    }
}

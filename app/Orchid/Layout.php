<?php

namespace App\Orchid;

use Orchid\Screen\Builder;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Legend;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Repository;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout as FacadesLayout;

class Layout extends FacadesLayout
{
    public static function legend(string $target, array $columns): Legend
    {
        return new class($target, $columns) extends Legend
        {
            protected $columns;
            protected string $class;

            public function __construct(string $target, array $columns)
            {
                $this->target = $target;
                $this->columns = $columns;
            }

            public function columns(): array
            {
                return $this->columns;
            }
            public function build(Repository $repository)
            {

                $this->query = $repository;

                if (! $this->isSee()) {
                    return;
                }

                $columns = collect($this->columns())->filter(static fn (Sight $sight) => $sight->isSee());

                $repository = $this->target
                    ? $repository->getContent($this->target)
                    : $repository;

                return view($this->template, [
                    'repository'    => $repository,
                    'columns'       => $columns,
                    'slug'          => $this->getSlug(),
                    'title'         => $this->title,
                    'class'         => $this->class,
                ]);
            }

            public function class($class='')
            {
                $this->class = $class;
                return $this;
            }

        };
    }

    public static function rows(array $fields): Rows
    {
        return new class($fields) extends Rows
        {

            protected $class    = '';
            /**
             * @var Field[]
             */
            protected $fields;

            /**
             *  constructor.
             */
            public function __construct(array $fields = [])
            {
                $this->fields = $fields;
            }

            public function fields(): array
            {
                return $this->fields;
            }

            public function class($class='')
            {
                $this->class = $class;
                return $this;
            }
            public function build(Repository $repository)
            {
                $this->query = $repository;

                if (! $this->isSee()) {
                    return;
                }

                $form = new Builder($this->fields(), $repository);

                return view($this->template, [
                    'form'  => $form->generateForm(),
                    'title' => $this->title,
                    'class'         => $this->class,
                ]);
            }

        };
    }
}

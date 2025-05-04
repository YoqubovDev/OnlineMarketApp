<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Newsletter;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Newsletter>
 */
class NewsletterResource extends ModelResource
{
    protected string $model = Newsletter::class;

    protected string $title = 'Newsletters';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            TinyMce::make('Description'),
            Text::make('Phone')->nullable(),
            Image::make('image'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                TinyMce::make('Description'),
                Text::make('Phone')->nullable(),
                Image::make('image'),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            TinyMce::make('Description'),
            Text::make('Phone')->nullable(),
            Image::make('image'),
        ];
    }

    /**
     * @param Newsletter $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\Language;
use App\Models\Template;
use App\Models\TemplateMedia;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class TemplateController extends Controller
{
    use Upload;

    public function show($section)
    {
        if (!array_key_exists($section, config('templates'))) {
            abort(404);
        }
        $languages = Language::all();
        $templates = Template::where('section_name', $section)->get()->groupBy('language_id');
        $templateMedia = TemplateMedia::where('section_name', $section)->first();
        return view('admin.template.show', compact('languages', 'section', 'templates', 'templateMedia'));
    }

    public function update(Request $request, $section, $language)
    {
        if (!array_key_exists($section, config('templates'))) {
            abort(404);
        }

        $purifiedData = Purify::clean($request->except('image', 'bread_crumb', 'left_image', 'right_image', 'thumbnail', '_token', '_method'));

        if ($request->has('image')) {
            $purifiedData['image'] = $request->image;
        }
        if ($request->has('thumbnail')) {
            $purifiedData['thumbnail'] = $request->thumbnail;
        }
        if ($request->has('bread_crumb')) {
            $purifiedData['bread_crumb'] = $request->bread_crumb;
        }
        if ($request->has('left_image')) {
            $purifiedData['left_image'] = $request->left_image;
        }
        if ($request->has('right_image')) {
            $purifiedData['right_image'] = $request->right_image;
        }


        $validate = Validator::make($purifiedData, config("templates.$section.validation"), config('templates.message'));
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        // save regular field
        $field_name = array_diff_key(config("templates.$section.field_name"), config("templates.template_media"));
        foreach ($field_name as $name => $type) {
            $description[$name] = $purifiedData[$name][$language];
        }
        $template = Template::where(['section_name' => $section, 'language_id' => $language])->firstOrNew();


        $template->language_id = $language;
        $template->section_name = $section;
        $template->description = $description ?? null;
        $template->save();


        // save template media
        if ($request->hasAny(array_keys(config('templates.template_media')))) {
            $templateMedia = TemplateMedia::where(['section_name' => $section])->firstOrNew();

            foreach (config('templates.template_media') as $key => $media) {
                $old_data = $templateMedia->description->{$key} ?? null;
                if ($request->hasFile($key)) {
                    $size = config("templates.{$section}.size")[$key] ?? null;
                    $templateMediaDescription[$key] = $this->uploadImage($purifiedData[$key][$language], config('location.template.path'), $size, $old_data);
                } elseif ($request->has($key)) {
                    $templateMediaDescription[$key] = linkToEmbed($purifiedData[$key][$language]);
                } elseif (isset($old_data)) {
                    $templateMediaDescription[$key] = $old_data;
                }
            }

            $templateMedia->section_name = $section;
            $templateMedia->description = $templateMediaDescription ?? null;
            $templateMedia->save();
        }

        return back()->with('success', 'Template Successfully Saved');
    }

}

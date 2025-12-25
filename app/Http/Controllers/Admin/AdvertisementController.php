<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ViewPaths\Admin\Advertisement;
use App\Http\Controllers\BaseController;
use App\Models\Advertisement as ModelsAdvertisement;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdvertisementController extends BaseController
{
    public function index(?Request $request, ?string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        $advertisements = ModelsAdvertisement::select('id', 'text')->latest()->get();

        return view(Advertisement::VIEW[VIEW], compact('advertisements'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'advertisements' => 'required|array',
            'advertisements.*' => 'required|string|max:255',
        ]);

        foreach ($request->advertisements as $text) {
            ModelsAdvertisement::create([
                'text' => $text,
            ]);

        }

        return back()->with('success', 'Advertisements saved successfully.');
    }

    public function update(Request $request, ModelsAdvertisement $advertisement): RedirectResponse
    {
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $advertisement->text = $request->text;
        $advertisement->save();

        return back()->with('success', 'Advertisement updated successfully.');
    }

    public function destroy(ModelsAdvertisement $advertisement): RedirectResponse
    {
        $advertisement->delete();

        return back()->with('success', 'Advertisement deleted successfully.');
    }
}

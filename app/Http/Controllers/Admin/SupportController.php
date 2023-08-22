<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    /**
     * @param SupportServices $service
     */
    public function __construct(protected SupportServices $service) {}


    /**
     * @param Request $request
     * @return Application
     */
    public function index(Request $request): Application
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 3),
            filter: $request->filter,
        );
        $filters = [ 'filter' => $request->get('filter', '')];
        return view('admin.supports.index', compact('supports', 'filters'));
    }

    /**
     * @return Application
     */
    public function create(): Application
    {
        return view('admin.supports.create');
    }


    /**
     * @param StoreUpdateSupport $request
     * @return RedirectResponse
     */
    public function store(StoreUpdateSupport $request): RedirectResponse
    {
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );
        return redirect()->route('supports.index')->with('message', 'Stored success.');
    }


    /**
     * @param string|int $id
     * @return Application|RedirectResponse
     */
    public function show(string|int $id): Application|RedirectResponse
    {
        $support = $this->service->findOne($id);
        if (!$support) {
            return back();
        }
        $support = (array)$support;
        return view('admin.supports.show', compact('support'));
    }


    /**
     * @param string|int $id
     * @return Application|RedirectResponse
     */
    public function edit(string | int $id): Application|RedirectResponse
    {
        if(!$support = $this->service->findOne($id) ) {
            return back();
        }
        return view('admin.supports.edit', compact('support'));
    }


    /**
     * @param StoreUpdateSupport $request
     * @return Application|RedirectResponse
     */
    public function update(StoreUpdateSupport $request): Application|RedirectResponse
    {
        /** @var Support $support */
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );
        if(!$support) {
            return back();
        }
        return redirect()->route('supports.index');
    }


    /**
     * @param string|int $id
     * @return RedirectResponse
     */
    public function destroy(string | int $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->route('supports.index');
    }
}

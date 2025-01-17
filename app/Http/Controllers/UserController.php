<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use CodeCoz\AimAdmin\Controller\AbstractAimAdminController;
use CodeCoz\AimAdmin\Field\IdField;
use CodeCoz\AimAdmin\Field\TextField;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;

class UserController extends AbstractAimAdminController
{
    private UserServiceInterface $userService;

    public function __construct(private readonly UserRepositoryInterface $repo, UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function getRepository()
    {
        return $this->repo;
    }

    public function configureActions(): iterable
    {
        return [

        ];
    }

    public function configureForm()
    {
        $fields = [
            IdField::init('id'),
            // TextareaField::init('my_remarks')
        ];
        $this->getForm($fields)
            ->setName('form_name')
            ->setMethod('post')
            ->setActionUrl(route('set_route'));
    }

    public function create()
    {
        $this->initCreate();
        return view('aim-admin::create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->initStore($request);

    }

    public function configureFilter(): void
    {
        $fields = [
            TextField::init('id'),
            // TextField::init('other')
        ];
        $this->getFilter($fields);
    }

    public function list()
    {
        $this->initGrid(['id'], pagination: 10);
        return view('aim-admin::list');
    }

    public function show($id)
    {
        $this->initShow($id, ['id', 'created_at']);
        return view('aim-admin::show');
    }

    public function edit($id)
    {
        $this->initEdit($id);
        return view('aim-admin::edit');
    }

    public function delete($id)
    {
     // Set your delete functionality
    }

}

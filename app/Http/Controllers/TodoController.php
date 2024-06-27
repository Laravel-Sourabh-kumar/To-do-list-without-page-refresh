<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  DataTables;
class TodoController extends Controller
{
    /**
     * View ToDos listing.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {




        $todoList = Todo::where('user_id', Auth::id())->paginate(10);
  if(\request()->ajax()){
    $data = Todo::where('user_id', Auth::id())->orderby('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<div class='form-inline' method='put'>";

                               if($row->status==0){
                      $actionBtn .= " <input type='hidden' value='1' name='status'> 
                                    <button type='button' class='btn btn-success btn-xs' onclick='updatemessage(".$row->id.")'><i class='fa fa-check-square'></i></button>";
                               } 
                               $actionBtn .="        </div>    "; 
                                
                           
                               $actionBtn .=   "<form action='todo-delete/".$row->id."' class='form-inline' method='delete'>
                             <input type='hidden' name='id' value='".$row->id."'>
                                 <button type='button' class='btn btn-danger btn-xs' onclick='deletemessage(".$row->id.")'><i class='fa fa-close'></i></button>
                                
                            </form>";
                    return $actionBtn;
                })

                ->addColumn('status', function($row){
                    if($row->status==0){
                        $statuscheck =  ' Non completed';
                    }
                    else{
                        $statuscheck =  'completed';
                    }
                    
                    return $statuscheck;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('todo.list', compact('todoList'));
    }

    /**
     * View Create Form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Create new Todo.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $todocheck= Todo::where('name',$request->get('name'))->first();
        if($todocheck==null){
            Todo::create([
                'name' => $request->get('name'),
                'user_id' => Auth::user()->id,
            ]);
 
        $msg = "New todo created successfully";
        
        return response()->json(array('msg'=> $msg), 200);
        }
        else{
            
            $msg = "Already Insert Data.";
         
            return response()->json(array('msg'=> $msg), 201);
        }
    }

    /**
     * Toggle Status.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->status = 1;
        $todo->save();
        $msg = "Todo updated successfully";
        
        return response()->json(array('msg'=> $msg), 200);
       
    }

    /**
     * Delete Todo.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        $msg = "Todo deleted successfully";
         
        return response()->json(array('msg'=> $msg), 201);
      
    }
}

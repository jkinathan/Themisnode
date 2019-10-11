<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\Expense;
use App\Matter;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $read_expenses=Expense::where('user_id',\Auth::user()->id)->get();
        return view('expense.list_of_expenses')->with(compact('read_expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $this->validate($request,["amount"=>"required"]);
        $save_Expense=new Expense();
        $save_Expense->description=$request->description;
        $save_Expense->amount=trim(str_replace(",", "", $request->amount));
        $to_date = date_create(str_replace("/", "-", $request->date_spent));       
        $save_Expense->date_spent=date_timestamp_get($to_date);
        $save_Expense->matter_id=$request->matter_id;
        $save_Expense->invoice_number=$request->invoice_number;
        $save_Expense->supplier_description=$request->supplier_description;
        $save_Expense->user_id=\Auth::user()->id;
        $save_Expense->company_id = \Auth::user()->company_id;

        if ($request->hasFile('filename')) {
            $file_name="themis_file_".time().".".$request->filename->getClientOriginalExtension();
            $save_Expense->file_name=$file_name;
            $request->filename->move(public_path('documents'),$file_name);
        }      

        try {
            $save_Expense->save();
            $status="Expense successfully.";

            $save_log=new LoggingController();
            $save_log->userlog($save_Expense->id,"Expense","Recording an Expense ".$_SERVER['REQUEST_URI']);


        } catch (\Exception $e) {}
        return redirect()->back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $read_Matter=Matter::find($id);
        $read_expenses=Expense::where('matter_id',$id)->get();
        return view('expense.list_of_expenses')->with(compact('read_expenses','read_Matter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $read_Matter=Matter::find($id);    
        return view('expense.create')->with(compact('read_Matter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

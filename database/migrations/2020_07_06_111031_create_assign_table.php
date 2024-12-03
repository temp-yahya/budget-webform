
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateAssignTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("assign", function (Blueprint $table) {

						$table->increments('id');
						$table->integer('project_id')->unsigned();
						$table->string('staff_id',10)->nullable();
						$table->string('role',20)->nullable();
                                                $table->double('budget_hour')->nullable();
						$table->timestamps();
						$table->softDeletes();
						//$table->foreign("id")->references("assign_id")->on("budget");
						//$table->foreign("project_id")->references("id")->on("project");
						//$table->foreign("staff_id")->references("id")->on("staff");



						// ----------------------------------------------------
						// -- SELECT [assign]--
						// ----------------------------------------------------
						// $query = DB::table("assign")
						// ->leftJoin("budget","budget.assign_id", "=", "assign.id")
						// ->leftJoin("project","project.id", "=", "assign.project_id")
						// ->leftJoin("staff","staff.id", "=", "assign.staff_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("assign");
            }
        }
    
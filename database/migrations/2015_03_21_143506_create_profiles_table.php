<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
            // required fields
            $table->string('nim', 8);
            $table->primary('nim');

            $table->integer('angkatan');
            $table->string('wali', 60);
            $table->string('nama_lengkap', 60);
            $table->string('nama_panggilan', 20);
            $table->string('foto_url', 100);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('telepon');
            $table->text('email');
            $table->text('alamat_asal');
            $table->text('alamat_bandung');
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');

            $table->enum('keanggotaan', ['Muda', 'Biasa', 'Kehormatan', 'Other']);

            // optional fields
            $table->string('mbti', 4);
            $table->string('nim_tpb', 8);
            $table->text('media_sosial');

            // MSDA's notes
            $table->text('catatan_msda');

            // the access rights for each of the fields
            $table->text('hak_lihat');

            // created_at and updated_at fields
            $table->timestamps();

            // foreign key to the members table
            $table->foreign('nim')->references('nim')->on('users')->onDelete('cascade');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profiles');
	}

}

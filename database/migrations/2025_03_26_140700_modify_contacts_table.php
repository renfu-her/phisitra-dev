<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // 刪除不需要的欄位
            $table->dropColumn([
                'name',
                'message',
                'status',
                'google_map_link',
                'is_active'
            ]);

            // 添加新欄位
            $table->string('name_zh')->after('id');      // 中文名稱
            $table->string('name_en')->after('name_zh'); // 英文名稱
            $table->string('fax')->after('phone');       // 傳真
        });

        // 更新資料
        DB::table('contacts')->truncate();
        DB::table('contacts')->insert([
            'name_zh' => '品閎投資有限公司',
            'name_en' => 'PING HUNG INVESTMENT CO. LTD.',
            'address' => '台北市中山區復興北路58號12樓',
            'phone' => '(02) 8772-3812',
            'fax' => '(02) 2775-2373',
            'email' => 'phi87723812@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // 恢復原有欄位
            $table->string('name')->after('id');
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->string('google_map_link')->nullable();
            $table->boolean('is_active')->default(true);

            // 刪除新增的欄位
            $table->dropColumn([
                'name_zh',
                'name_en',
                'fax'
            ]);
        });
    }
}; 
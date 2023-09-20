<?php

namespace App\Models\Import;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property int uploader_id
 * @property string file_name
 * @property string import_type
 * @property string status
 * @property string result
 * @property Carbon deleted_at
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Import extends Model
{
    use HasFactory, RelationshipTrait, RelationshipTrait, ScopesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uploader_id',
        'file_name',
        'import_type',
        'status',
        'result'
    ];

    /**
     * Delete its file from storage before deleting.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(): ?bool
    {
        Storage::delete($this->file_name);

        return parent::delete();
    }
}

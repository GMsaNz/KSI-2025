namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::with('players')->get();
        return view('clubs.index', compact('clubs'));
    }

    public function show(Club $club)
    {
        return view('clubs.show', compact('club'));
    }
}
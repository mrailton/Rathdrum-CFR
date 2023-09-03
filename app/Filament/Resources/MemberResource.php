<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function ucfirst;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Label')
                    ->tabs([
                        Tab::make('Contact')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('status')
                                    ->required()
                                    ->options(['inactive' => 'Inactive', 'active' => 'Active'])
                                    ->default('Inactive'),
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->default('Responder'),
                                TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                            ]),
                        Tab::make('Address')
                            ->schema([
                                TextInput::make('address_1')
                                    ->maxLength(255),
                                TextInput::make('address_2')
                                    ->maxLength(255),
                                TextInput::make('eircode')
                                    ->maxLength(255),
                            ]),
                        Tab::make('Certs')
                            ->schema([
                                TextInput::make('cfr_certificate_number')
                                    ->label('CFR Certificate Number')
                                    ->maxLength(255),
                                DatePicker::make('cfr_certificate_expiry')
                                    ->label('CFR Certificate Expiry'),
                                DatePicker::make('volunteer_declaration')
                                    ->label('Volunteer Declaration Signed'),
                                TextInput::make('garda_vetting_id')
                                    ->label('Garda Vetting ID')
                                    ->maxLength(255),
                                DatePicker::make('garda_vetting_date')
                                    ->label('Garda Vetting Date'),
                                DatePicker::make('cism_completed')
                                    ->label('CISM Completed Date'),
                                DatePicker::make('child_first_completed')
                                    ->label('Children First Completed Date'),
                                DatePicker::make('ppe_community_completed')
                                    ->label('PPE Community Completed Date'),
                                DatePicker::make('ppe_acute_completed')
                                    ->label('PPE Acute Completed Date'),
                                DatePicker::make('hand_hygiene_completed')
                                    ->label('Hand Hygiene Completed Date'),
                                DatePicker::make('hiqa_completed')
                                    ->label('HIQA Completed Date'),
                                DatePicker::make('covid_return_completed')
                                    ->label('COVID Return Completed Date'),
                                DatePicker::make('ppe_assessment_completed')
                                    ->label('PPE Assessment Completed Date'),
                            ])
                    ])
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable()
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
                TextColumn::make('cfr_certificate_expiry')
                    ->label('CFR Certificate Expiry')
                    ->date()
                    ->sortable(),
                TextColumn::make('garda_vetting_date')
                    ->label('Garda Vetting Expiry')
                    ->formatStateUsing(fn (Carbon $state): string => $state->addYears(3)->format('M j, Y'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\NotesRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'view' => Pages\ViewMember::route('/{record}'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}

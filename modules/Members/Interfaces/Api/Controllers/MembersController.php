<?php

namespace Motorola\Members\Interfaces\Api\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Motorola\Members\Domain\Attributes\MemberData;
use Motorola\Members\Members;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MembersController
{
    public function index(): JsonResponse
    {
        return response()->json(
            Members::all()->toArray(),
        );
    }

    public function show($id): JsonResponse
    {
        return response()->json(
            Members::getById($id)->toArray(),
        );
    }

    public function store(MemberData $memberData): JsonResponse
    {
        try {
            $memberData = Members::create($memberData);
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage()
                ],
                ResponseAlias::HTTP_CREATED
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Member created successfully',
                'member' => $memberData->toArray(),
            ],
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(MemberData $memberData): JsonResponse
    {
        try {
            $member = Members::update($memberData);
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage()
                ],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Member updated successfully',
                'member' => $member->toArray(),
            ],
            ResponseAlias::HTTP_OK
        );
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Members::delete($id);
        } catch (Exception $exception) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage()
                ]
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Member deleted successfully',
            ]
        );
    }
}

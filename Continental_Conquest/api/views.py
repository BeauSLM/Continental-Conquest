from django.http.response import JsonResponse
from rest_framework.parsers import JSONParser
from django.contrib.auth.models import User, Group
from django.shortcuts import render
from rest_framework import viewsets, permissions, status
from rest_framework.decorators import api_view
from api.serializers import *
from api.models import *

# Create your views here.
@api_view(['GET'])
def player_list(request):
    if request.method == 'GET':
        players = Players.objects.all()

        player = request.GET.get('player', None)
        if player is not None:
            players = players.filter(player__icontains=player)

        players_serializer = PlayersSerializer(players, many=True)
        return JsonResponse(players_serializer.data, safe=False)

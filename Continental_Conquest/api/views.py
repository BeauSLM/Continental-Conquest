from rest_framework import viewsets, permissions
from api.serializers import *
from api.models import *

# Create your views here.
class PlayerViewSet(viewsets.ModelViewSet):
    queryset = Players.objects.all() 
    serializer_class = PlayersSerializer

class CharacterViewSet(viewsets.ModelViewSet):
    queryset = Characters.objects.all() 
    serializer_class = CharactersSerializer

class GuildViewSet(viewsets.ModelViewSet):
    queryset = Guild.objects.all() 
    serializer_class = GuildSerializer

class TicketViewSet(viewsets.ModelViewSet):
    queryset = Ticket.objects.all() 
    serializer_class = TicketSerializer

class ClassabilityViewSet(viewsets.ModelViewSet):
    queryset = ClassAbility.objects.all() 
    serializer_class = ClassabilitySerializer

class ItemViewSet(viewsets.ModelViewSet):
    query = Item.objects.all()
    serializer_class = ItemSerializer

class ItemstatsViewSet(viewsets.ModelViewSet):
    query = ItemStats.objects.all()
    serializer_class = ItemstatSerializer

class CharstatsViewSet(viewsets.ModelViewSet):
    query = CharStats.objects.all()
    serializer_class = CharstatsSerializer


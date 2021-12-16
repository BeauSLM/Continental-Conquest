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
    queryset = Item.objects.all()
    serializer_class = ItemSerializer

class ItemstatsViewSet(viewsets.ModelViewSet):
    queryset = ItemStats.objects.all()
    serializer_class = ItemstatSerializer

class CharstatsViewSet(viewsets.ModelViewSet):
    queryset = CharStats.objects.all()
    serializer_class = CharstatsSerializer

class RaceabilityViewSet(viewsets.ModelViewSet):
    queryset = RaceAbility.objects.all()
    serializer_class = RaceabilitySerializer

class AbilityViewSet(viewsets.ModelViewSet):
    queryset = Ability.objects.all()
    serializer_class = AbilitySerializer

class PartyViewSet(viewsets.ModelViewSet):
    queryset = Part.objects.all()
    serializer_class = PartySerializer

class ItemclassreqViewSet(viewsets.ModelViewSet):
    queryset = ItemClassReq.objects.all()
    serializer_class = ItemclassreqSerializer

class RaceViewSet(viewsets.ModelViewSet):
    queryset = Race.objects.all()
    serializer_class = RaceSerializer

class ClassViewSet(viewsets.ModelViewSet):
    queryset = Class.objects.all()
    serializer_class = ClassSerializer

